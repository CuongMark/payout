<?php


namespace Angel\Payout\Controller\Adminhtml\Payout;

use Angel\Payout\Model\Payout;
use Angel\Payout\Model\Payout\Status;
use Magento\Framework\Encryption\Encryptor;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    private $encryptor;
    private $authSession;
    private $date;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        Encryptor $encryptor,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->encryptor = $encryptor;
        $this->authSession = $authSession;
        $this->date = $date;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        /** @var $user \Magento\User\Model\User */
        $user = $this->authSession->getUser();

        if ($data) {
            $id = $this->getRequest()->getParam('payout_id');

            /** @var Payout $model */
            $model = $this->_objectManager->create(\Angel\Payout\Model\Payout::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Payout no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            try {

                if (!$this->encryptor->validateHash($data['security_pass'], $model->getSecurityPass()) && $data['status'] == Status::STATUS_PAID){
                    $this->messageManager->addErrorMessage(__('The Security Pass is not valid.'));
                    return $resultRedirect->setPath('*/*/edit', ['payout_id' => $this->getRequest()->getParam('payout_id')]);
                }

                $model->getResource()->beginTransaction();
                /** Before updating admin user data, ensure that password of current admin user is entered and is correct */
                $currentUserPasswordField = \Magento\User\Block\User\Edit\Tab\Main::CURRENT_USER_PASSWORD_FIELD;
                $currentUserPassword = $this->getRequest()->getParam($currentUserPasswordField);
                $user->performIdentityCheck($currentUserPassword);

                unset($data['security_pass']);
                unset($data['currency']);
                unset($data[$currentUserPasswordField]);

                if ($model->getStatus() == Status::STATUS_PROCESSING && $data['status'] == Status::STATUS_CANCELED){
                    $this->_eventManager->dispatch(
                        'payout_request_cancel_after',
                        ['payout' => $this->payout]
                    );
                }

                if ($model->getStatus() == Status::STATUS_PROCESSING && $data['status'] == Status::STATUS_PAID){
                    $data['pay_at'] = $this->date->date();
                }
                $model->setData($data);

                $model->setAdminId($user->getId());
                $model->setUpdatedAt($this->date->date());

                $model->unsetData('amount');
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Payout.'));
                $this->dataPersistor->clear('angel_payout_payout');

                $model->getResource()->commit();
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['payout_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $model->getResource()->rollBack();
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $model->getResource()->rollBack();
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        
            $this->dataPersistor->set('angel_payout_payout', $data);
            return $resultRedirect->setPath('*/*/edit', ['payout_id' => $this->getRequest()->getParam('payout_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

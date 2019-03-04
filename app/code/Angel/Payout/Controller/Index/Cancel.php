<?php


namespace Angel\Payout\Controller\Index;

use Angel\Payout\Api\PayoutRepositoryInterface;
use Angel\Payout\Model\Payout;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlInterface;

class Cancel extends \Magento\Framework\App\Action\Action
{
    private $session;
    private $urlModel;
    private $payout;
    private $payoutRepository;
    private $payoutModel;

    public function __construct(
        Context $context,
        Session $session,
        UrlInterface $urlModel,
        PayoutRepositoryInterface $payoutRepository,
        Payout $payoutModel
    ){
        parent::__construct($context);
        $this->session = $session;
        $this->urlModel = $urlModel;
        $this->payoutRepository = $payoutRepository;
        $this->payoutModel = $payoutModel;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$this->session->isLoggedIn()) {
            $resultRedirect->setPath('*/*/');
            $this->messageManager->addErrorMessage(__('Your are not logged in'));
            return $resultRedirect;
        }

        try {
            $this->payoutModel->getResource()->beginTransaction();

            $customer = $this->session->getCustomer();
            $this->payout = $this->payoutRepository->getById($this->getRequest()->getParam('id'));
            if ($this->payout->getCustomerId() != $customer->getId()){
                throw new \Exception(__('You are not the owner'));
            }

            $this->_eventManager->dispatch(
                'payout_request_cancel',
                ['payout' => $this->payout]
            );

            $this->payout->setStatus(Payout\Status::STATUS_CANCELED);

            $this->_eventManager->dispatch(
                'payout_request_cancel_after',
                ['payout' => $this->payout]
            );

            $this->payoutRepository->save($this->payout);

            $this->payoutModel->getResource()->commit();
            $this->messageManager->addSuccessMessage(__('You canceled payout request #%1 successfully', $this->payout->getPayoutId()));
        } catch (\Exception $e){
            $this->payoutModel->getResource()->rollBack();
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $url = $this->urlModel->getUrl('*/', ['_secure' => true]);
        $resultRedirect->setUrl($this->_redirect->error($url));
        return $resultRedirect;
    }
}

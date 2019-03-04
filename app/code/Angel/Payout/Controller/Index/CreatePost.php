<?php


namespace Angel\Payout\Controller\Index;

use Angel\Payout\Api\Data\PayoutInterface;
use Angel\Payout\Api\PayoutRepositoryInterface;
use Angel\Payout\Model\Payout;
use Angel\Payout\Model\Payout\Status;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Encryption\Encryptor;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Store\Model\StoreManagerInterface;

class CreatePost extends \Magento\Framework\App\Action\Action
{
    private $session;
    private $urlModel;
    private $formKeyValidator;
    private $payout;
    private $payoutRepository;
    private $storeManager;
    private $payoutModel;
    private $encryptor;

    public function __construct(
        Context $context,
        Session $session,
        UrlInterface $urlModel,
        Validator $validator,
        StoreManagerInterface $storeManager,
        PayoutInterface $payout,
        PayoutRepositoryInterface $payoutRepository,
        Payout $payoutModel,
        Encryptor $encryptor
    ){
        parent::__construct($context);
        $this->session = $session;
        $this->urlModel = $urlModel;
        $this->formKeyValidator = $validator;
        $this->payout = $payout;
        $this->payoutRepository = $payoutRepository;
        $this->storeManager = $storeManager;
        $this->payoutModel = $payoutModel;
        $this->encryptor = $encryptor;
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
            $resultRedirect->setPath('*/*/create');
            $this->messageManager->addErrorMessage(__('somethings went wrong 1.'));
            return $resultRedirect;
        }

        if (!$this->getRequest()->isPost() || !$this->formKeyValidator->validate($this->getRequest())) {
            $url = $this->urlModel->getUrl('*/*/create', ['_secure' => true]);
            $resultRedirect->setUrl($this->_redirect->error($url));
            $this->messageManager->addErrorMessage(__('somethings went wrong 2.'));
            return $resultRedirect;
        }

        try {
        $this->payoutModel->getResource()->beginTransaction();

        $customer = $this->session->getCustomer();
        $this->payout->setCustomerId($customer->getId())
            ->setCustomerEmail($customer->getEmail())
            ->setAmount((float)$this->getRequest()->getParam('amount'))
            ->setCurrency($this->storeManager->getWebsite()->getBaseCurrencyCode())
            ->setComment($this->getRequest()->getParam('comment'))
            ->setSecurityPass($this->encryptor->hash($this->getRequest()->getParam('security_pass')))
            ->setStatus(Status::STATUS_PENDING);
        if ($defaultBillingAddress = $customer->getPrimaryBillingAddress()){
            $this->payout->setPhoneNumber($defaultBillingAddress->getTelephone());
        }

        $this->_eventManager->dispatch(
            'payout_request_create_success',
            ['payout' => $this->payout]
        );

        $this->payoutRepository->save($this->payout);

        $this->payoutModel->getResource()->commit();
        $this->messageManager->addSuccessMessage(__('You created payout request successfully', $this->payout->getPayoutId()));
        } catch (\Exception $e){
            $this->payoutModel->getResource()->rollBack();
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $url = $this->urlModel->getUrl('*/', ['_secure' => true]);
        $resultRedirect->setUrl($this->_redirect->error($url));
        return $resultRedirect;
    }
}

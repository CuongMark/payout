<?php


namespace Angel\Payout\Controller\Adminhtml\Payout;

class Detail extends \Angel\Payout\Controller\Adminhtml\Payout
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('security_pass');
        $model = $this->_objectManager->create(\Angel\Payout\Model\Payout::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id, 'security_pass');
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Payout no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('angel_payout_payout', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(__('Payout Request Detail'),__('Payout Request Detail') );
        $resultPage->getConfig()->getTitle()->prepend(__('Payout Request Detail'));
        return $resultPage;
    }
}

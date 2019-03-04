<?php


namespace Angel\Payout\Controller\Adminhtml\Payout;

class Delete extends \Angel\Payout\Controller\Adminhtml\Payout
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('payout_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Angel\Payout\Model\Payout::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Payout.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['payout_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Payout to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

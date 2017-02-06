<?php


namespace Alex\TestProject\Controller\Adminhtml\Question;

use Magento\Cms\Controller\Adminhtml\Block;
use Alex\TestProject\Model\Question;

class Delete extends Block
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(Question::class);
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccessMessage(__('Question delete.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('Error while deleting.'));

        return $resultRedirect->setPath('*/*/');
    }
}
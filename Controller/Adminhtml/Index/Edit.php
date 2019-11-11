<?php

namespace Vaimo\Events\Controller\Adminhtml\Index;

use Vaimo\Events\Controller\Adminhtml\AbstractEvent;

class Edit extends AbstractEvent
{
    const TITLE = 'Event Edit';

    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
                $this->sessionManager->setCurrentEventModel($model);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }
        } else {
            if($this->_getSession()->getFormData()){
                $model = $this->getModel();
                $model->setData($this->_getSession()->getFormData());
                $this->_getSession()->setFormData(null);
                $this->sessionManager->setCurrentEventModel($model);
            }
        }
        return parent::execute();
    }
}

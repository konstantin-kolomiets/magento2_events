<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 11:18
 */

namespace Vaimo\Events\Controller\Adminhtml\Index;

use Vaimo\Events\Api\Data\BaseEventsInterface as EventsInterface;
use Vaimo\Events\Controller\Adminhtml\AbstractEvent;
use Magento\Framework\Exception\LocalizedException;

class Save extends AbstractEvent
{
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();
        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('event');
            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
                if(isset($formData['image'][0])) {
                    $formData['image'] = $formData['image'][0]['name'];
                }
            }
            if(!empty($formData[EventsInterface::FIELD_ID])) {
                $id = $formData[EventsInterface::FIELD_ID];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[EventsInterface::FIELD_ID]);
            }
            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Event has been saved.'));
                $this->_getSession()->setFormData(null);
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Event doesn\'t save' ));
            }
            $this->_getSession()->setFormData($formData);
            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/edit');
        }
        return $this->doRefererRedirect();
    }

}
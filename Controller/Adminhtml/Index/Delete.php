<?php

namespace Vaimo\Events\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;

    public function __construct(
        Action\Context $context,
        \Vaimo\Events\Model\Event $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $formId = $this->getRequest()->getParam('id');
        if ($formId) {
            try {
                $model = $this->_model;
                $model->load($formId);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Form Details has been deleted.'));
                $resultRedirect->setPath('events/index/index');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('Details no longer exists.'));
                return $resultRedirect->setPath('events/index/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('events/index/index', ['vaimo_events_event_id' => $formId]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the details'));
                return $resultRedirect->setPath('events/index/index', ['vaimo_events_event_id' => $formId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find details to delete.'));
        return $resultRedirect->setPath('events/index/index');
    }
}
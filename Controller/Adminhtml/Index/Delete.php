<?php

namespace Vaimo\Events\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Vaimo\Events\Api\BaseEventsRepositoryInterface as Repository;

class Delete extends Action
{
    private $repository;

    public function __construct(Repository $repository,
                                Context $context
    ) {
        parent::__construct($context);
        $this->repository = $repository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $formId = $this->getRequest()->getParam('id');
        if ($formId) {
            try {
                $this->repository->deleteById($formId);
                $this->messageManager->addSuccessMessage(__('Form Details has been deleted.'));
                $resultRedirect->setPath('events/index/index');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the details'));
                return $resultRedirect->setPath('events/index/index', ['vaimo_events_event_id' => $formId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find details to delete.'));
        return $resultRedirect->setPath('events/index/index');
    }
}
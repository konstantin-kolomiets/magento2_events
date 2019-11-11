<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 11:21
 */

namespace Vaimo\Events\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Vaimo\Events\Model\BaseEventsFactory;
use Vaimo\Events\Api\BaseEventsRepositoryInterface as Repository;

abstract class AbstractEvent extends Action
{

    const ACL_RESOURCE          = "Vaimo_Events::main_menu";
    const QUERY_PARAM_ID        = 'id';
    const TITLE                 = 'Events';
    const BREADCRUMB_TITLE      = 'Events';

    protected $model;
    protected $eventFactory;
    protected $resultPage;
    protected $repository;
    protected $sessionManager;
    protected $pageFactory;

    public function __construct(BaseEventsFactory $baseEventFactory,
                                PageFactory $pageFactory,
                                SessionManagerInterface $sessionManager,
                                Repository $repository,
                                Context $context
    ) {
        $this->eventFactory    = $baseEventFactory;
        $this->pageFactory     = $pageFactory;
        $this->sessionManager  = $sessionManager;
        $this->repository      = $repository;
        parent::__construct($context);
    }

    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }
        return $this->resultPage;
    }

    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }

    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->getConfig()->getTitle()->prepend((__(static::TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        return $this;
    }

    public function _isAllowed()
    {
        $result = parent::_isAllowed(); // TODO: Change the autogenerated stub
        $result = $result && $this->_authorization->isAllowed($this::ACL_RESOURCE);
        return $result;
    }

    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/index');
    }
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
    protected function getModel()
    {
        if($this->model === null) {
            return $this->eventFactory->create();
        } else return $this->model;
    }
}
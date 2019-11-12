<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 15:52
 */

namespace Vaimo\Events\Controller\Adminhtml\EventsSubscriptions;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Vaimo\Events\Api\Data\EventSubscriptionsInterface;
use Vaimo\Events\Api\SubsEventRepositoryInterface as Repository;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;

class MassDelete extends Action
{
    const QUERY_PARAM_ID = 'id';
    const PATH_TO_GRID = '*/*/index';
    private $searchCriteriaBuilderFactory;
    private $repository;

    public function __construct(SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
                                Repository $repository,
                                Context $context)
    {
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->repository = $repository;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            throw new \Magento\Framework\Exception\NotFoundException(__('Elements not found.'));
        }
        $ids = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');
        if($ids) {
            try {
                foreach ($ids as $id) {
                    $this->repository->deleteById($id);
                }
                $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', count($ids)));
                return $this->_redirect(static::PATH_TO_GRID);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go to grid
                return $this->_redirect(static::PATH_TO_GRID);
            }
        } elseif ($excluded) {
            $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
            $searchCriteria = $searchCriteriaBuilder->addFilter(EventSubscriptionsInterface::FIELD_ID, $excluded, 'nin')->create();
            $listElevators = $this->repository->getList($searchCriteria)->getItems();

            foreach ($listElevators as $elevator) {
                $this->repository->delete($elevator);
            }
        }
        return $this->_redirect(static::PATH_TO_GRID);
    }
}
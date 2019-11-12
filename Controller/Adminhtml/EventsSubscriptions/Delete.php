<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 15:21
 */

namespace Vaimo\Events\Controller\Adminhtml\EventsSubscriptions;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Vaimo\Events\Api\SubsEventRepositoryInterface as Repository;

class Delete extends Action
{
    const QUERY_PARAM_ID = 'id';
    const PATH_TO_GRID = '*/*/index';
    private $repository;

    public function __construct(Repository $repository,
                                Context $context)
    {
        $this->repository = $repository;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if ($id) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted chosen item.'));

                // go to grid
                return $this->_redirect(static::PATH_TO_GRID);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());

                // go to grid
                return $this->_redirect(static::PATH_TO_GRID);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find an item to delete.'));

        // go to grid
        return $this->_redirect(static::PATH_TO_GRID);
    }
}

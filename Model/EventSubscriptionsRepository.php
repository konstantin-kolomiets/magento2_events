<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 13:18
 */

namespace Vaimo\Events\Model;

use Vaimo\Events\Api\SubsEventRepositoryInterface;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions as ResourceModel;
use Vaimo\Events\Model\EventSubscriptionsFactory as ModelFactory;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\Search\SearchResultInterface;

class EventSubscriptionsRepository implements SubsEventRepositoryInterface
{
    private $resourceModel;
    private $modelFactory;
    private $collectionFactory;
    private $collectionProcessor;
    private $searchResult;

    public function __construct(SearchResultInterface $searchResult,
                                CollectionProcessorInterface $collectionProcessor,
                                CollectionFactory $collectionFactory,
                                ResourceModel $resourceModel,
                                ModelFactory $modelFactory)
    {
        $this->searchResult = $searchResult;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
    }

    public function save(\Vaimo\Events\Api\Data\EventSubscriptionsInterface $sub)
    {
        try {
            $this->resourceModel->save($sub);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $sub;
    }

    public function delete(\Vaimo\Events\Api\Data\EventSubscriptionsInterface $sub)
    {
        try {
            $this->resourceModel->delete($sub);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }

    public function deleteById($id)
    {
        try {
            $this->delete($this->getById($id));
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
        }
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);;
        $this->searchResult->setSearchCriteria($searchCriteria);
        $this->searchResult->setItems($collection->getItems());
        $this->searchResult->setTotalCount($collection->getSize());

        return $this->searchResult;
    }

    public function getById($id)
    {
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id);
        if (!$model->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Event with id "%1" does not exist.', $id));
        }

        return $model;
    }
}

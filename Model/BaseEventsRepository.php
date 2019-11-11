<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 10:50
 */

namespace Vaimo\Events\Model;

use Magento\Framework\Api\SearchCriteriaBuilderFactory;

class BaseEventsRepository implements \Vaimo\Events\Api\BaseEventsRepositoryInterface
{
 
    private $baseEventsFactory;
 
    private $resourceModel;

    private $collectionFactory;
 
    private $collectionProcessor;
  
    private $searchResultFactory;

    public function __construct(
        \Vaimo\Events\Model\BaseEventsFactory $baseEventsFactory,
        \Vaimo\Events\Model\ResourceModel\Event $resourceModel,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Vaimo\Events\Model\ResourceModel\Event\CollectionFactory $collectionFactory,
        \Magento\Framework\Api\Search\SearchResultInterfaceFactory $searchResult
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory   = $collectionFactory;
        $this->resourceModel       = $resourceModel;
        $this->baseEventsFactory   = $baseEventsFactory;
        $this->searchResultFactory = $searchResult;
    }
 
    public function getById($id)
    {
        $Events = $this->baseEventsFactory->create();
        $this->resourceModel->load($Events, $id);
        if (!$Events->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Event with id "%1" does not exist.', $id));
        }
        return $Events;
    }
   
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
   
    public function deleteById($id)
    {
        try {
            $this->delete($this->getById($id));
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
        }
    }
   
    public function delete(\Vaimo\Events\Api\Data\BaseEventsInterface $baseEvents)
    {
        try {
            $this->resourceModel->delete($baseEvents);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }
   
    public function save(\Vaimo\Events\Api\Data\BaseEventsInterface $baseEvents)
    {
        try {
            $this->resourceModel->save($baseEvents);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }
        return $baseEvents;
    }

}
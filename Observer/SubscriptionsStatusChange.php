<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-15
 * Time: 14:53
 */

namespace Vaimo\Events\Observer;

use Magento\Framework\Event\ObserverInterface;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions\CollectionFactory;
use Vaimo\Events\Api\Data\EventSubscriptionsInterface;
use Vaimo\Events\Api\SubsEventRepositoryInterface;

class SubscriptionsStatusChange implements ObserverInterface
{
    private $collectionFactory;
    private $repository;

    public function __construct(
        CollectionFactory $collectionFactory,
        SubsEventRepositoryInterface $repository
    ) {
        $this->collectionFactory   = $collectionFactory;
        $this->repository          = $repository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $deletedEvent = $observer->getData('deleted_event');

        $collection = $this->collectionFactory->create()->addFieldToFilter(EventSubscriptionsInterface::FIELD_EVENTS_ID, ['eq' => $deletedEvent->getId()]);

        foreach ($collection->getItems() as $item){
            $item->setStatus(0);
            $this->repository->save($item);
        }

        return $this;
    }
}
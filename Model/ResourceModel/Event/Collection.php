<?php

namespace Vaimo\Events\Model\ResourceModel\Event;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vaimo\Events\Model\Event;
use Vaimo\Events\Model\ResourceModel\Event as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Event::class, ResourceModel::class);
    }
}
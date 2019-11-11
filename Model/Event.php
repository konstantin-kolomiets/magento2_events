<?php

namespace Vaimo\Events\Model;

use Magento\Framework\Model\AbstractModel;

class Event extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vaimo\Events\Model\ResourceModel\Event');
    }
}
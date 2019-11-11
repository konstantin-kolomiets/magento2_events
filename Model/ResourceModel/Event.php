<?php

namespace Vaimo\Events\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Event extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vaimo_events_event', 'vaimo_events_event_id');
    }
}
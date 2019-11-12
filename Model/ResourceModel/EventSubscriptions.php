<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 09:46
 */

namespace Vaimo\Events\Model\ResourceModel;

use Vaimo\Events\Api\Data\EventSubscriptionsInterface as MainInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class EventSubscriptions extends AbstractDb
{
    public function _construct()
    {
        $this->_init(MainInterface::TABLE_NAME,MainInterface::FIELD_ID);
    }
}
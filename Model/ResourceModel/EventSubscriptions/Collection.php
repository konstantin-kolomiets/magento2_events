<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 09:59
 */

namespace Vaimo\Events\Model\ResourceModel\EventSubscriptions;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vaimo\Events\Model\EventSubscriptions as Model;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 09:50
 */

namespace Vaimo\Events\Model;

use Magento\Framework\Model\AbstractModel;
use Vaimo\Events\Api\Data\EventSubscriptionsInterface as MainInterface;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions as ResourceModel;

class EventSubscriptions extends AbstractModel implements MainInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getId()
    {
        return $this->getData(MainInterface::FIELD_ID);
    }

    public function getEventsId()
    {
        return $this->getData(MainInterface::FIELD_EVENTS_ID);
    }

    public function getName()
    {
        return $this->getData(MainInterface::FIELD_NAME);
    }

    public function getStatus()
    {
        return $this->getData(MainInterface::FIELD_STATUS);
    }

    public function getPhone()
    {
        return $this->getData(MainInterface::FIELD_PHONE);
    }

    public function setEventsId($id)
    {
        $this->setData(MainInterface::FIELD_EVENTS_ID, $id);
    }

    public function setName($name)
    {
        $this->setData(MainInterface::FIELD_NAME, $name);
    }

    public function setStatus($status)
    {
        $this->setData(MainInterface::FIELD_STATUS, $status);
    }

    public function setPhone($phone)
    {
        $this->setData(MainInterface::FIELD_PHONE, $phone);
    }
}

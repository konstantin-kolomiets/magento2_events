<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 10:41
 */

namespace Vaimo\Events\Model;

use Magento\Framework\Model\AbstractModel;
use Vaimo\Events\Api\Data\BaseEventsInterface;
use Vaimo\Events\Model\ResourceModel\Event as ResourseModel;

class BaseEvents extends AbstractModel implements BaseEventsInterface
{

    public function _construct()
    {
        $this->_init(ResourseModel::class);
    }
    
    public function getCurrentTitle()
    {
        return $this->getData(BaseEventsInterface::FIELD_CURRENT_TITLE);
    }
    
    public function setCurrentTitle($title)
    {
        $this->setData(BaseEventsInterface::FIELD_CURRENT_TITLE,$title);
    }
    
    public function getDescription()
    {
        return $this->getData(BaseEventsInterface::FIELD_DESCRIPTION);
    }
    
    public function setDescription($description)
    {
        $this->setData(BaseEventsInterface::FIELD_DESCRIPTION,$description);
    }
   
    public function getEventTime()
    {
        return $this->getData(BaseEventsInterface::FIELD_EVENT_TIME  );
    }
    
    public function setEventTime($eventTime)
    {
        $this->setData(BaseEventsInterface::FIELD_EVENT_TIME  ,$eventTime);
    }

    public function getImage()
    {
        return $this->getData(BaseEventsInterface::FIELD_IMAGE  );
    }

    public function setImage($icon)
    {
        $this->setData(BaseEventsInterface::FIELD_IMAGE  ,$icon);
    }

    public function getActive()
    {
        return $this->getData(BaseEventsInterface::FIELD_ACTIVE  );
    }

    public function setActive($yesno)
    {
        $this->setData(BaseEventsInterface::FIELD_ACTIVE  ,$yesno);
    }
}
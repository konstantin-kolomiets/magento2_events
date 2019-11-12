<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 10:12
 */

namespace Vaimo\Events\Controller\Adminhtml\EventsSubscriptions;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;


class Index extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
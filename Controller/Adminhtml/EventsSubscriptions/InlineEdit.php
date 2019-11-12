<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 14:07
 */

namespace Vaimo\Events\Controller\Adminhtml\EventsSubscriptions;

use Magento\Backend\App\Action;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Vaimo\Events\Model\EventSubscriptionsRepository as Repository;

class InlineEdit extends Action
{
    private $jsonFactory;
    private $repository;
    public function __construct(Repository $eventSubscriptionsRepository,
                                JsonFactory $jsonFactory,
                                Context $context)
    {
        $this->repository  = $eventSubscriptionsRepository;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $sub) {
                    $order = $this->repository->getById($sub);
                    try {
                        $order->setData(array_merge($order->getData(), $postItems[$sub]));
                        $this->repository->save($order);
                    } catch (\Exception $e) {
                        $messages[] = __($e->getMessage());
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

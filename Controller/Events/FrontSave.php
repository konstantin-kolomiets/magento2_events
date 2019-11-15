<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-12
 * Time: 17:50
 */

namespace Vaimo\Events\Controller\Events;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Vaimo\Events\Model\EventSubscriptionsFactory;
use Vaimo\Events\Api\SubsEventRepositoryInterface as EventsRepository;

class FrontSave extends Action
{
    private $repository;
    private $orderFactory;
    private $jsonFactory;

    public function __construct(
        JsonFactory $jsonFactory,
        Context $context,
        EventSubscriptionsFactory $eventsFactory,
        EventsRepository $eventsRepository
    )
    {
        parent::__construct($context);
        $this->jsonFactory =$jsonFactory;
        $this->repository = $eventsRepository;
        $this->orderFactory = $eventsFactory;

    }
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $formData = $this->getRequest()->getParams();
        $error = false;
        $messages = [];

        try{
            $this->repository->save($this->orderFactory->create()->setData($formData));
            $messages[]='Thank you! Form has been saved.';

        } catch (\Exception $e){
            if ($e->getMessage()) {
                $messages[]=$e->getMessage();
                $error = true;
            } else {
                $messages[]='Form doesn\'t save please try again';
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
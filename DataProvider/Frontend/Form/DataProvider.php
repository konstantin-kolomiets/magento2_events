<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 16:43
 */

namespace Vaimo\Events\DataProvider\Frontend\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions\CollectionFactory;
use Vaimo\Events\Model\EventSubscriptionsFactory;
use Magento\Customer\Model\SessionFactory;

class DataProvider extends AbstractDataProvider
{
    private $modelFactory;
    private $sessionFactory;

    public function __construct(SessionFactory $sessionFactory,
                                EventSubscriptionsFactory $modelFactory,
                                CollectionFactory $collectionFactory,
                                $name,
                                $primaryFieldName,
                                $requestFieldName,
                                array $meta = [],
                                array $data = []
    ) {
        $this->sessionFactory = $sessionFactory;
        $this->modelFactory = $modelFactory;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $session = $this->sessionFactory->create();
        if ($session->getCustomer()->getName()) {
            $model = $this->modelFactory->create();
            $model->setName($session->getCustomer()->getName());
            if ($session->getCustomer()->getDefaultShippingAddress()) {
                $model->setPhone($session->getCustomer()->getDefaultShippingAddress()->getTelephone());
            }

            return [$model->getId() => $model->getData()];
        }

        return [];
    }
}

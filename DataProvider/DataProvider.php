<?php

namespace Vaimo\Events\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\Session\SessionManagerInterface;
use Vaimo\Events\Model\ResourceModel\Event\Collection;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends AbstractDataProvider
{
    public $sessionManager;
    public $storeManager;

    public function __construct( Collection $collection,
                                 SessionManagerInterface $sessionManager,
                                 StoreManagerInterface $storeManager,
                                 $name,
                                 $primaryFieldName,
                                 $requestFieldName,
                                 array $meta = [],
                                 array $data = [])
    {
        $this->collection = $collection;
        $this->sessionManager  =  $sessionManager;
        $this->storeManager  =  $storeManager;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $model = $this->sessionManager->getCurrentEventModel();
        $this->sessionManager->setCurrentEventModel(null);
        if($model!=null) {
//            return [$model->getId()=> $model->getData()];
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getImage()) {
                $m['image'][0]['name'] = $model->getImage();
                $m['image'][0]['url'] = $this->getMediaUrl().$model->getImage();
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
            }
            return $this->loadedData;
        } else return [];


    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'events/tmp/icon/';
        return $mediaUrl;
    }

}
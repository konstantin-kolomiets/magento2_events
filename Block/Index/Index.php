<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-11
 * Time: 11:31
 */

namespace Vaimo\Events\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
    private $eventCollectionFactory;
    private $storeManager;
    private $templateProcessor;
    private $scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Vaimo\Events\Model\ResourceModel\Event\CollectionFactory $eventCollectionFactory,
        array $data = []
    ) {
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->storeManager = $context->getStoreManager();
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context, $data);
    }

    public function getEventsCollection()
    {
        $eventsCollection = $this->eventCollectionFactory->create();
        $eventsCollection->addFieldToFilter('is_active', 1);

        return $eventsCollection;
    }

    public function getImageUrl($icon)
    {
        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaUrl.'events/tmp/icon/'.$icon;
        return $imageUrl;
    }

    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCurrentStore()
    {
        return $this->storeManager->getStore()->getId();
    }
}
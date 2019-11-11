<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 16:23
 */

namespace Vaimo\Events\UI\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Asset\Repository;

class GroupIcon extends \Magento\Ui\Component\Listing\Columns\Column
{
    private $storeManager;
    private $assetRepo;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        Repository $assetRepo,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->assetRepo = $assetRepo;
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $path = $this->storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ).'events/tmp/icon/';
            $baseImage = $this->assetRepo->getUrl('Vaimo_Events::images/image.jpg');
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['image']) {
                    $item['image' . '_src'] = $path.$item['image'];
                    $item['image' . '_alt'] = 'Hello';
                    $item['image' . '_orig_src'] = $path.$item['image'];
                } else {
                    $item['image' . '_src'] = $baseImage;
                    $item['image' . '_alt'] = 'Event';
                    $item['image' . '_orig_src'] = $baseImage;
                }
            }
        }
        return $dataSource;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-08
 * Time: 10:47
 */

namespace Vaimo\Events\Block\Adminhtml\Events\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
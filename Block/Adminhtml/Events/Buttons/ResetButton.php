<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-08
 * Time: 11:03
 */

namespace Vaimo\Events\Block\Adminhtml\Events\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 11:36
 */

namespace Vaimo\Events\Block\Adminhtml\Events\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Event'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 15:46
 */

namespace Vaimo\Events\Model\Source\EventSubscriptions;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => 0,
                'label' => __('Event was deleted')
            ],
            [
                'value' => 1,
                'label' => __('Accepted')
            ],
            [
                'value' => 2,
                'label' => __('Refused')
            ]
        ];
    }

    public function toArray()
    {
        return [
            0 => __('Event was deleted'),
            1 => __('Accepted'),
            2 => __('Refused')
        ];
    }
}
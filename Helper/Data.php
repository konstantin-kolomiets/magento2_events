<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-11
 * Time: 12:26
 */

namespace Vaimo\Events\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
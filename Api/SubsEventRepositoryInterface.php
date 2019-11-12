<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 13:14
 */

namespace Vaimo\Events\Api;

interface SubsEventRepositoryInterface
{
    public function getById($id);

    public function deleteById($id);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    public function save(\Vaimo\Events\Api\Data\EventSubscriptionsInterface $sub);

    public function delete(\Vaimo\Events\Api\Data\EventSubscriptionsInterface $sub);
}

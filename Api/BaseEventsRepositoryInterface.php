<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 2019-11-07
 * Time: 10:20
 */

namespace Vaimo\Events\Api;

interface BaseEventsRepositoryInterface
{

    public function getById($id);

    public function deleteById($id);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    public function save(\Vaimo\Events\Api\Data\BaseEventsInterface $baseEvents);

    public function delete(\Vaimo\Events\Api\Data\BaseEventsInterface $baseEvents);
}
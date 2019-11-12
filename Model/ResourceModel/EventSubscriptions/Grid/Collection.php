<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-12
 * Time: 10:01
 */

namespace Vaimo\Events\Model\ResourceModel\EventSubscriptions\Grid;

use Vaimo\Events\Model\ResourceModel\EventSubscriptions\Collection as ResursCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Vaimo\Events\Model\ResourceModel\EventSubscriptions as Model;
use Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends ResursCollection implements SearchResultInterface
{
    protected $aggregations;

    protected function _construct()
    {
        $this->_init(Document::class, Model::class);
    }

    public function getAggregations()
    {
        return $this->aggregations;
    }

    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function getAllIds($limit = null, $offset = null)
    {
        return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items = null)
    {
        return $this;
    }
}
<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Model\ResourceModel\Task;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use TenCommerce\Todo\Api\Data\TaskSearchResultInterface;
use TenCommerce\Todo\Model\Task;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;

class Collection extends AbstractCollection implements TaskSearchResultInterface
{
    /**
     * @var SearchCriteriaInterface
     */
    private $searchCriteria;

    protected function _construct()
    {
        $this->_init(Task::class, TaskResource::class);
    }

    /**
     * Get search criteria
     *
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * Set search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return Collection
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * Get total count
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count
     *
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @param array $items
     * @return $this
     * @throws \Exception
     */
    public function setItems(array $items)
    {
        if (!$items) {
            return $this;
        }
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }
}

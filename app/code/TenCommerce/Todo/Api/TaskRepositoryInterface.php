<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use TenCommerce\Todo\Api\Data\TaskInterface;
use TenCommerce\Todo\Api\Data\TaskSearchResultInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : TaskSearchResultInterface;

    /**
     * @param int $taskId
     * @return TaskInterface
     */
    public function get(int $taskId) : TaskInterface;
}

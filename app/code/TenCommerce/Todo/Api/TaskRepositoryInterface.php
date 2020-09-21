<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use TenCommerce\Todo\Api\Data\TaskSearchResultInterface;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria) : TaskSearchResultInterface;
    public function get(int $taskId);
}

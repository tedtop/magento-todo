<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Service;

use TenCommerce\Todo\Api\Data\TaskInterface;
use TenCommerce\Todo\Api\TaskManagementInterface;
use TenCommerce\Todo\Model\ResourceModel\Task;

class TaskManagement implements TaskManagementInterface
{
    private $resource;

    public function __construct(Task $resource)
    {
        $this->resource = $resource;
    }

    public function save(TaskInterface $task)
    {
        $this->resource->save($task);
    }

    public function delete(TaskInterface $task)
    {
        $this->resource->delete($task);
    }
}

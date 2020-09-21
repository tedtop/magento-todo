<?php

namespace TenCommerce\Todo\Service;

use TenCommerce\Todo\Api\TaskRepositoryInterface;
use TenCommerce\Todo\Model\ResourceModel\Task;
use TenCommerce\Todo\Model\TaskFactory;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private $resource;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    public function __construct(Task $resource, TaskFactory $taskFactory)
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
    }
    public function getList()
    {
        // TODO: Implement getList() method.
    }

    public function get(int $taskId)
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}

<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Service;

use Magento\Framework\Exception\AlreadyExistsException;
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

    /**
     * @param TaskInterface $task
     * @return bool
     * @throws AlreadyExistsException
     */
    public function save(TaskInterface $task) : bool
    {
        $this->resource->save($task);
        return true;
    }

    /**
     * @param TaskInterface $task
     * @return bool
     * @throws \Exception
     */
    public function delete(TaskInterface $task) : bool
    {
        $this->resource->delete($task);
        return true;
    }
}

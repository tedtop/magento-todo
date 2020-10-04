<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Service;

use TenCommerce\Todo\Api\TaskManagementInterface;
use TenCommerce\Todo\Api\TaskRepositoryInterface;
use TenCommerce\Todo\Api\TaskStatusManagementInterface;
use TenCommerce\Todo\Model\Task;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $repository;

    /**
     * @var TaskManagementInterface
     */
    private $management;

    /**
     * TaskStatusManagement constructor.
     * @param TaskRepositoryInterface $repository
     * @param TaskManagementInterface $management
     */
    public function __construct(
        TaskRepositoryInterface $repository,
        TaskManagementInterface $management
    ) {
        $this->repository = $repository;
        $this->management = $management;
    }

    /**
     * @param int $taskId
     * @param string $status
     * @return bool
     */
    public function change(int $taskId, string $status) : bool
    {
        if (!in_array($status, ['open', 'complete'])) {
            return false;
        }

        $task = $this->repository->get($taskId);
        $task->setData(Task::STATUS, $status);

        $this->management->save($task);

        return true;
    }
}

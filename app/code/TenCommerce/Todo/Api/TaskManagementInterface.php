<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Api;

use TenCommerce\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface TaskManagementInterface
{
    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function save(TaskInterface $task) : bool;

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function delete(TaskInterface $task) : bool;
}

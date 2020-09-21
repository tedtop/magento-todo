<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Api;

use TenCommerce\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface TaskManagementInterface
{
    public function save(TaskInterface $task);
    public function delete(TaskInterface $task);
}

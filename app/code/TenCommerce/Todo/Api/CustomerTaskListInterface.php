<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Api;

use TenCommerce\Todo\Api\Data\TaskInterface;

interface CustomerTaskListInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getList();
}

<?php

namespace TenCommerce\Todo\Api;

/**
 * @api
 */
interface TaskRepositoryInterface
{
    public function getList();
    public function get(int $taskId);
}

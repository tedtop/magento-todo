<?php

namespace TenCommerce\Todo\Api;

/**
 * @api
 */
interface TaskManagementInterface
{
    public function save();
    public function delete();
}

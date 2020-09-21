<?php

namespace TenCommerce\Todo\Model\ResourceModel\Task;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use TenCommerce\Todo\Model\ResourceModel\Task;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Task::class, TaskResource::class);
    }
}

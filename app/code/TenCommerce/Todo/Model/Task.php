<?php

namespace TenCommerce\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;

class Task extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(TaskResource::class);
    }
}

<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use TenCommerce\Todo\Api\Data\TaskInterface;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;

class Task extends AbstractModel implements TaskInterface
{
    protected function _construct()
    {
        $this->_init(TaskResource::class);
    }
}

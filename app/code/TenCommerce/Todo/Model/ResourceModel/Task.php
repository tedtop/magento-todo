<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Task extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('tencommerce_todo_task', 'task_id');
    }
}

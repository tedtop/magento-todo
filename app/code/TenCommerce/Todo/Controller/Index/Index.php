<?php

declare(strict_types=1);

namespace TenCommerce\Todo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use TenCommerce\Todo\Api\TaskRepositoryInterface;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;
use TenCommerce\Todo\Model\TaskFactory;
use TenCommerce\Todo\Service\TaskRepository;

class Index extends Action
{
    private $taskResource;

    private $taskFactory;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        TaskResource $taskResource,
        TaskRepository $taskRepository
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        // Add task example
        $task = $this->taskFactory->create();
        $task->setData([
            'label' => 'New Task 42',
            'status' => 'open',
            'customer_id' => 1
        ]);
        $this->taskResource->save($task);

        // Get task example
        $task = $this->taskRepository->get(1);
        var_dump($task->getData());

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

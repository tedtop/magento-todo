<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Controller\Index;

use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use TenCommerce\Todo\Api\TaskManagementInterface;
use TenCommerce\Todo\Model\ResourceModel\Task as TaskResource;
use TenCommerce\Todo\Model\TaskFactory;
use TenCommerce\Todo\Service\TaskRepository;

class Index extends Action
{
    private $taskResource;

    private $taskFactory;

    private $taskRepository;

    private $searchCriteriaBuilder;

    private $taskManagement;

    public function __construct(
        Context $context,
        TaskFactory $taskFactory,
        TaskResource $taskResource,
        TaskRepository $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TaskManagementInterface $taskManagement
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->taskManagement = $taskManagement;
        parent::__construct($context);
    }

    public function execute()
    {
//        // Add task example
//        $task = $this->taskFactory->create();
//        $task->setData([
//            'label' => 'New Task 42',
//            'status' => 'open',
//            'customer_id' => 1
//        ]);
//        $this->taskResource->save($task);

        $task = $this->taskRepository->get(1);
        $task->setData('status', 'complete');
        $this->taskManagement->save($task);

        // Get task example
        $tasks = $this->taskRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        var_dump($tasks);

        //return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

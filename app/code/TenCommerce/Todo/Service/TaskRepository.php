<?php
declare(strict_types=1);

namespace TenCommerce\Todo\Service;

use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use TenCommerce\Todo\Api\Data\TaskInterface;
use TenCommerce\Todo\Api\Data\TaskSearchResultInterface;
use TenCommerce\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use TenCommerce\Todo\Api\TaskRepositoryInterface;
use TenCommerce\Todo\Model\ResourceModel\Task;
use TenCommerce\Todo\Model\TaskFactory;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private $resource;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionsProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        Task $resource,
        TaskFactory $taskFactory,
        CollectionProcessor $collectionProcessor,
        TaskSearchResultInterfaceFactory $searchResultFactory
    ) {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultFactory;
    }

    public function getList(SearchCriteriaInterface $searchCriteria) : TaskSearchResultInterface
    {
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->getSearchCriteria($searchCriteria);

        $this->collectionProcessor->process($searchCriteria, $searchResult);

        return $searchResult;
    }

    public function get(int $taskId) : TaskInterface
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}

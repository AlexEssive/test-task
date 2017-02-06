<?php


namespace Alex\TestProject\Model;


use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Alex\TestProject\Api\Data\QuestionInterface;
use Alex\TestProject\Api\QuestionRepositoryInterface;
use Alex\TestProject\Model\ResourceModel\Question as QuestionResourceModel;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var array
     */
    protected $instancesById = [];

    /**
     * @var \Alex\TestProject\Model\ResourceModel\Question
     */
    protected $resourceModel;
    /**
     * @var QuestionFactory
     */
    private $questionFactory;
    /**
     * @var QuestionResourceModel\CollectionFactory
     */
    private $collectionFactory;

    /**
     * QuestionRepository constructor.
     * @param QuestionFactory $questionFactory
     * @param QuestionResourceModel\CollectionFactory $collectionFactory
     * @param QuestionResourceModel $resourceModel
     */
    public function __construct(
        QuestionFactory $questionFactory,
        QuestionResourceModel\CollectionFactory $collectionFactory,
        QuestionResourceModel $resourceModel
    )
    {
        $this->resourceModel = $resourceModel;
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question)
    {
        try {
            $this->resourceModel->save($question);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Unable to save question'));
        }

        unset($this->instancesById[$question->getId()]);
        return $this->getById($question->getId());
    }

    /**
     * @param int $questionId
     * @param bool $editMode
     * @param int|null $storeId
     * @param bool $forceReload
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById($questionId, $editMode = false, $storeId = null, $forceReload = false)
    {
        $cacheKey = $this->getCacheKey([$editMode, $storeId]);
        if (!isset($this->instancesById[$questionId][$cacheKey]) || $forceReload) {
            $question = $this->questionFactory->create();
            if ($editMode) {
                $question->setData('_edit_mode', true);
            }
            if ($storeId !== null) {
                $question->setData('store_id', $storeId);
            }
            $this->resourceModel->load($question, $questionId, 'question_id');
            if (!$question->getId()) {
                throw new NoSuchEntityException(__('Requested question doesn\'t exist'));
            }
            $this->instancesById[$questionId][$cacheKey] = $question;
        }
        return $this->instancesById[$questionId][$cacheKey];
    }

    /**
     * @param \Alex\TestProject\Api\Data\QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question)
    {
        $questionId = $question->getId();
        try {
            $this->resourceModel->delete($question);
        } catch(\Exception $e) {

        }
        unset($this->instancesById[$questionId]);
        return true;
    }

    /**
     * @param int $questionId
     * @return bool
     */
    public function deleteById($questionId)
    {
        $question = $this->getById($questionId);
        return $this->delete($question);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var QuestionResourceModel\Collection $collection */
        $collection = $this->collectionFactory->create();
        /** @var SortOrder $sortOrder */
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $field = $sortOrder->getField();
            $collection->addOrder(
                $field,
                ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
            );
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->load();

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
    }

    /**
     * Clean internal product cache
     *
     * @return void
     */
    public function cleanCache()
    {
        $this->instancesById = [];
    }

    /**
     * Get key for cache
     *
     * @param array $data
     * @return string
     */
    protected function getCacheKey($data)
    {
        $serializeData = [];
        foreach ($data as $key => $value) {
            if (is_object($value)) {
                $serializeData[$key] = $value->getId();
            } else {
                $serializeData[$key] = $value;
            }
        }

        return md5(serialize($serializeData));
    }
}
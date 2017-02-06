<?php


namespace Alex\TestProject\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Alex\TestProject\Api\Data\QuestionInterface;

interface QuestionRepositoryInterface
{
    /**
     * @param \Alex\TestProject\Api\Data\QuestionInterface
     */
    public function save(QuestionInterface $question);

    /**
     * @param int $questionId
     * @param bool $editMode
     * @param int|null $storeId
     * @param bool $forceReload
     * @return QuestionInterface
     */
    public function getById($questionId, $editMode = false, $storeId = null, $forceReload = false);

    /**
     * @param \Alex\TestProject\Api\Data\QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question);

    /**
     * @param int $questionId
     * @return bool
     */
    public function deleteById($questionId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
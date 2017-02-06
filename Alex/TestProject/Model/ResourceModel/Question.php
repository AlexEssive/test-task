<?php
namespace Alex\TestProject\Model\ResourceModel;

class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(\Alex\TestProject\Model\Question::TABLE_NAME, 'id');
    }
}
<?php
namespace Alex\TestProject\Model\ResourceModel\Question;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Alex\TestProject\Model\Question', 'Alex\TestProject\Model\ResourceModel\Question');
    }
}

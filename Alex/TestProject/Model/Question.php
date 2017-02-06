<?php

namespace Alex\TestProject\Model;

use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{

    const TABLE_NAME = 'user_questions';

    protected function _construct()
    {
        $this->_init('Alex\TestProject\Model\ResourceModel\Question');
    }
}
<?php


namespace Alex\TestProject\Block\Adminhtml;


class Question extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Alex_TestProject';
        $this->_controller = 'adminhtml_contactform';
        $this->_headerText = __('Items');
        parent::_construct();
    }
}
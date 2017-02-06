<?php
namespace Alex\TestProject\Block\Adminhtml\Question;


use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize blog post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Alex_TestProject';
        $this->_controller = 'adminhtml_question';

        parent::_construct();

        if ($this->_isAllowedAction('Alex_TestProject::save')) {
            $this->buttonList->update('save', 'label', __('Answer and save status of question'));
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Alex_TestProject::question_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete question'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Edit question');
    }
}
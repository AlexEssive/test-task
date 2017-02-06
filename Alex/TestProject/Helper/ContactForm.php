<?php
namespace Alex\TestProject\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class ContactForm extends AbstractHelper
{
    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->_getUrl('contactform/index/post');
    }
}
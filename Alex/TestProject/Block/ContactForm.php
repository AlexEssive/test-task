<?php
namespace Alex\TestProject\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Alex\TestProject\Helper\ContactForm as ContactFormHelper;

class ContactForm extends Template
{
    /**
     * @var ContactFormHelper
     */
    protected $contactFormHelper;

    /**
     * ContactForm constructor.
     * @param Context $context
     * @param ContactFormHelper $contactFormHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        ContactFormHelper $contactFormHelper,
        array $data
    )
    {
        parent::__construct($context, $data);
        $this->contactFormHelper = $contactFormHelper;
    }

    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->contactFormHelper->getSubmitUrl();
    }
}
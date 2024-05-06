<?php

namespace Kitchen\Company\Block\Index;

use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $urlBuilder;
    protected $customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerFactory $customerFactory,
        UrlInterface $urlBuilder,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerFactory = $customerFactory;
        $this->customerSession = $customerSession;
        $this->urlBuilder = $urlBuilder;
    }

    public function getWelcomeText()
    {
        return 'This is Block';
    }

    
}

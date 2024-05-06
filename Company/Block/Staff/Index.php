<?php

namespace Kitchen\Company\Block\Staff;

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

    public function display()
    {
        $customerId = $this->getIds(); // Get the customer ID from the request parameters
        $customerCollection = $this->customerFactory->create()->getCollection();
        $customerCollection->addFieldToFilter('parent_id', $customerId);

        foreach ($customerCollection as $customer) {
            echo "<tr>";
            echo "<td>" . $customer->getEntityId() . "</td>";
            echo "<td>" . $customer->getParentId() . "</td>";
            echo "<td>" . $customer->getFirstname() . "</td>";
            echo "<td>" . $customer->getLastname() . "</td>";
            echo "<td>" . $customer->getEmail() . "</td>";
            echo "<td>" . $customer->getCreatedAt() . "</td>";
            echo "<td>" . $customer->getUpdatedAt() . "</td>";
            echo "<td><a href='" . $this->urlBuilder->getUrl('comp/staff/create', ['entity_id' => $customer->getId()]) . "'>Edit</a></td>";
            echo "</tr>";
        }
    }

    public function getIds(){
        $customer = $this->customerSession->getCustomer()->getId();
        return $customer;
    }
}

<?php

namespace Kitchen\Notification\Block;

use Kitchen\Notification\Model\NoticeFactory;
use Kitchen\Notification\Model\NotificationFactory;


class Notice extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    protected $noticeFactory;
    protected $notificationFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        NoticeFactory $noticeFactory,
        NotificationFactory $notificationFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->noticeFactory = $noticeFactory;
        $this->notificationFactory = $notificationFactory;
        $this->customerSession = $customerSession;
    }
    public function getFilteredNotifications()
    {
        // $customerId = $this->customerSession->getCustomerId();
        $customerGroupId = $this->customerSession->getCustomerGroupId();
 
        return $customerGroupId;
    }
    public function getTitles()
    {
        $collection =   $this->noticeFactory->create()->getCollection()->addFieldToFilter('customer_group',$this->getFilteredNotifications());
        foreach ($collection as $item) {
            echo "<td>".$item->getTitle()."</td>";
 
        }
    }
    
    public function getDesc()
    {
        $collection =   $this->noticeFactory->create()->getCollection()->addFieldToFilter('customer_group',$this->getFilteredNotifications());
        foreach ($collection as $item) {
            echo "<td>".$item->getdescription()."</td>";
 
        }
    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function CustomerCheck()
    {
        return $this->customerSession->isLoggedIn();
    }
    public function isMarked()
        {
            $customerId = $this->customerSession->getCustomerId();
            if (!$customerId) {
                return false;
            }
 
            $notification = $this->notificationFactory->create()->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->addFieldToFilter('notice_id', 1)  
                ->getFirstItem();
 
            return (bool) $notification->getId();  
    }
}

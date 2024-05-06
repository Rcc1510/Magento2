<?php
namespace Kitchen\Notification\Controller\Index;

use Kitchen\Notification\Model\NotificationFactory;
use Magento\Customer\Model\Session as CustomerSession;
 
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $notificationFactory;
    protected $customerSession;
 
 
    public function __construct(
        NotificationFactory $notificationFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        CustomerSession $customerSession,
 
    ) {
        parent::__construct($context);
 
        $this->notificationFactory = $notificationFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;
 
    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
        $checks = '';
        $checks =$data['value'];
        $customerId = $this->customerSession->getCustomerId();
  
        $getNotice = $this->notificationFactory->create();
        $getNotice->setNoticeId($checks);
        $getNotice->setCustomerId($customerId);
        $getNotice->save();
 
        return $result->setData([
            'checkbox' => $checks,
            'message' => 'checks exists'
        ]);
    }
}
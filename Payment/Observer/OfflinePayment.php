<?php
namespace Kitchen\Payment\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Payment\Model\MethodInterface;
use Magento\Customer\Model\Session as CustomerSession;
 
class OfflinePayment implements ObserverInterface
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * OfflinePayment constructor.
     *
     * @param CustomerSession $customerSession
     */
    public function __construct(
        CustomerSession $customerSession
    ) {
        $this->customerSession = $customerSession;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var MethodInterface $methodInstance */
        $methodInstance = $observer->getMethodInstance();
        
        /** @var Quote $quote */
        $quote = $observer->getQuote();
        if ($this->customerSession->isLoggedIn()) {
            // Get customer group ID
            $customerGroupId = $this->customerSession->getCustomer()->getGroupId();
            // echo $customerGroupId;  
        
            // Check if the method instance is the one you want to restrict
            if ($methodInstance->getCode() == 'invoice30') {
                // Check if the customer group meets your criteria
                $CustomerGroup = $methodInstance->getConfigData('customer_group');
                // $RetailerCustomerGroup = $methodInstance->getConfigData('retailer_customer_group');
                // $WholesaleCustomerGroup = $methodInstance->getConfigData('wholesale_customer_group');
                
                
                if ($customerGroupId == $CustomerGroup 
                // || $customerGroupId == $RetailerCustomerGroup || $customerGroupId == $WholesaleCustomerGroup
                ) {
                    // Allow the payment method
                    $result = $observer->getResult();
                    $result->setData('is_available', true);
                } else {
                    // Disable the payment method
                    $result = $observer->getResult();
                    $result->setData('is_available', false);
                }
            }
        }
    }
}

<?php
namespace Kitchen\Company\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote_item');
        $product = $item->getProduct();
        
        if($customPrice = $product->getData('custom_price_field')){
            $priceType = $product->getCustomPriceType();
            $defaultPrice = $product->getFinalPrice(); // Adjust price with product count
            
            if ($priceType == 0) {
                $newPrice = $defaultPrice + $customPrice;
            } elseif ($priceType == 1) {
                $percentage = $customPrice / 100; // Assuming custom_price_field holds the percentage value
                $discountAmount = $defaultPrice * $percentage;
                $newPrice = $defaultPrice - $discountAmount;
            } else {
                // Default to the default price if no valid price type is provided
                $newPrice = $defaultPrice;
            }
            
            // Set custom price
            $item->setCustomPrice($newPrice);
            $item->setOriginalCustomPrice($newPrice);
            $item->getProduct()->setIsSuperMode(true);    
        }
    }
}

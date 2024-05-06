<?php
 
namespace Kitchen\Company\Plugin;
 
class PriceDiscount
{
    protected $cacheTypeList;
 
    public function __construct(
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
    ) {
        $this->cacheTypeList = $cacheTypeList;
    }
 
    public function afterGetFinalPrice(
        \Magento\Catalog\Model\Product $subject,
        $result,
        $qty = null
    ) {
        $product = $subject->load($subject->getId());
        // Get custom attributes
        $priceType = (float)$product->getData('custom_price_type');
        $prices = (float)$product->getData('custom_price_field');
 
        // Adjust price based on custom attributes
        if ((float)$result > 0 && $prices > 0 && in_array($priceType,[0,1])) {
            if ($priceType == 0) {
                $result =  $result + (float)$prices; // If price type is 0, return fixed price
            } elseif ($priceType == 1) {
                // If price type is 1, apply percentage discount
                $discount = $prices / 100;
                $result = (float)($result- ($result * $discount));
            }
        }
        return $result; // Return original price if no adjustment needed
    }
}
 
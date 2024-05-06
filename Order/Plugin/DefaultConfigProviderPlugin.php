<?php

namespace Kitchen\Order\Plugin;

class DefaultConfigProviderPlugin
{
  protected $checkoutSession;

  public function __construct(
    \Magento\Checkout\Model\Session $checkoutSession
  ) {
    $this->checkoutSession   = $checkoutSession;
  }
  public function afterGetConfig(
    \Magento\Checkout\Model\DefaultConfigProvider $subject,
    $output
  ) {
    $quote = $this->checkoutSession->getQuote();
    $shipping =  $quote->getShippingTypes();
    $output['shipping_types'] = $shipping;
   
    $output['residential'] = (int) $quote->getResidential();
    $output['liftgate'] = (int) $quote->getLiftgate();
    $output['delivery'] = (int) $quote->getDelivery();

    return $output;
  }
}

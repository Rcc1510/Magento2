<?php

namespace Kitchen\Order\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Checkout\Model\Session as CheckoutSession;

class Delete extends Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        // Retrieve current quote from checkout session
        $quote = $this->checkoutSession->getQuote();

        // Check if the quote's value is 0
        if ($quote->getIsActive() == 1) {
            // Set is_active flag to false
            $quote->setIsActive(0);

            // Save the quote
            $quote->save();

            // Return a JSON response indicating success
            $result = $this->resultJsonFactory->create();
            return $result->setData(['success' => true, 'message' => 'Quote deactivated successfully.']);
        } else {
            // Return a JSON response indicating failure
            $result = $this->resultJsonFactory->create();
            return $result->setData(['success' => false, 'message' => 'Quote value is not 0.']);
        }
    }
}

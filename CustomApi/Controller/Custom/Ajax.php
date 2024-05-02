<?php

namespace Kitchen\CustomApi\Controller\Custom;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\RequestInterface;

class Ajax extends Action
{
    protected $quoteRepository;
    protected $resultJsonFactory;
    protected $checkoutSession;

    public function __construct(
        Context $context,
        QuoteRepository $quoteRepository,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
        $this->quoteRepository = $quoteRepository;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute()
    {
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);

        $customData = ''; // Initialize $customData

        if (isset($data['value'])) {
            $customData = $data['value'];
        }
        
        $quote = $this->checkoutSession->getQuote();
        if ($quote->getId()) {
            $quote->setCustomShipping($customData);
            $this->quoteRepository->save($quote);
            echo $quote->getId();
        } else {
            echo "Not Found Quote";
        }
    }
}

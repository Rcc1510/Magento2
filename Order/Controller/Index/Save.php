<?php

namespace Kitchen\Order\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\QuoteFactory;
use Magento\Quote\Model\QuoteRepository;
use Magento\Customer\Model\Session as CustomerSession;

class Save extends Action
{
    protected $resultJsonFactory;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $cartManagementInterface;
    protected $quoteRepository;
    protected $customerSession;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        QuoteFactory $quoteFactory,
        CartManagementInterface $cartManagementInterface,
        QuoteRepository $quoteRepository,
        CustomerSession $customerSession
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory = $quoteFactory;
        $this->cartManagementInterface = $cartManagementInterface;
        $this->quoteRepository = $quoteRepository;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
 
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
        $shipValue = '';
        if (isset($data['value'])) {
            $shipValue = $data['value'];
        }
        $customer = $this->customerSession->getCustomerDataObject();
        $customerId = $customer->getId();
        $quoteId = $this->cartManagementInterface->createEmptyCartForCustomer($customerId);
        $quote = $this->quoteRepository->getActive($quoteId);
        $quote->setData('shipping_types', $shipValue);
        $this->quoteRepository->save($quote);
        $result->setData([
            'success' => true,
            'message' => 'Shipping type updated successfully.'
        ]);
    return $result;
    }
}

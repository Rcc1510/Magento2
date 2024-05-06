<?php
namespace Kitchen\Company\Controller\Staff;

use Magento\Framework\UrlInterface;
class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_url;
	protected $customerSession;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $customerSession,
		UrlInterface $url
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->customerSession = $customerSession;
		$this->_url = $url;
		return parent::__construct($context);
	}

	public function execute()
	{
		echo "Hello World".$this->getIds();
        return $this->_pageFactory->create();
		
	}
	public function getIds(){
        $customer = $this->customerSession->getCustomer()->getId();
        return $customer;
    }
}
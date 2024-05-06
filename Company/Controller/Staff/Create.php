<?php
namespace Kitchen\Company\Controller\Staff;

use Magento\Framework\UrlInterface;

class Create extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_url;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		UrlInterface $url
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_url = $url;
		return parent::__construct($context);
	}

	public function execute()
	{
		echo "Create";
        return $this->_pageFactory->create();
		
	}
}
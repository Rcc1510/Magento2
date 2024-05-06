<?php
namespace Kitchen\Knockout\Block;
 
use Kitchen\Knockout\Model\CustomerFactory;
 
class ViewAbstract extends \Magento\Framework\View\Element\Template
{
    protected $configProvider;
    protected $customerFactory;
    protected $_layoutProcessors;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        CustomerFactory $customerFactory,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
        $this->customerFactory = $customerFactory;
        $this->_layoutProcessors = $layoutProcessors;
    }
 
    public function getJsLayout()
    {
        foreach ($this->_layoutProcessors as $processor) {  
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return parent::getJsLayout();
    }
 
    public function getValues()
    {
        $getGallery = $this->customerFactory->create();
        $getData = $getGallery->getCollection();
        $getArr = [];
        foreach ($getData as $row) {
            $getArr[] = $row->getData();
        }
        return json_encode($getArr);
    }
}
 
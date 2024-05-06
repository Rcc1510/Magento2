<?php

namespace Kitchen\Company\Controller\Staff;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\CustomerFactory;

class Delete extends Action
{
    protected $customerFactory;
    protected $message1;
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->customerFactory = $customerFactory;
        $this->message1= $messageManager;
        parent::__construct($context);
    }
    

    public function execute()
{
    $id = $this->getRequest()->getparam("entity_id");
    $del = $this->customerFactory->create()->load($id);
    $del->delete();
    $this->message1->addSuccess(__('User data has been deleted.'));
    $this->redirect('comp/staff/index');
}





}


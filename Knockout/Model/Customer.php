<?php

namespace Kitchen\Knockout\Model;

class Customer extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Knockout\Model\ResourceModel\Customer::class);
    }
}

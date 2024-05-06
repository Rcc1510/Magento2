<?php

namespace Kitchen\Knockout\Model\ResourceModel\Customer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'customer_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Knockout\Model\Customer::class,
            \Kitchen\Knockout\Model\ResourceModel\Customer::class
        );
    }
}


<?php

namespace Kitchen\Knockout\Model\ResourceModel;

class Customer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_customer', 'customer_id');
        // $this->_init('kitchen_product', 'entity_id');
    }
}

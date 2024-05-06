<?php

namespace Kitchen\Notification\Model\ResourceModel;

class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('kitchen_notice_customer', 'entity_id');
    }
}

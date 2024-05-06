<?php

namespace Kitchen\Notification\Model\ResourceModel;

class Notice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('kitchen_notification', 'notification_id');
    }
}

<?php

namespace Kitchen\Notification\Model\ResourceModel\Notification;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Notification\Model\Notification::class,
            \Kitchen\Notification\Model\ResourceModel\Notification::class
        );
    }
}

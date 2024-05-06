<?php

namespace Kitchen\Notification\Model;

class Notification extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Notification\Model\ResourceModel\Notification::class);
    }
}

<?php
namespace Kitchen\Order\Api;

interface OrderInterface
{
    /**
     * Retrieve order data filtered by selected order IDs.
     *
     * @param string $OrderIds
     * @return array
     */
    public function getUserData($OrderIds);    
}

<?php

namespace Kitchen\Order\Plugin\Api;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;

class OrderPlugin
{
    /**
     * Order Extension Factory
     *
     * @var OrderExtensionFactory
     */
    protected $extensionFactory;

    /**
     * Constructor
     *
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(OrderExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * After Get plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function afterGet(OrderRepositoryInterface $subject, OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes() ?: $this->extensionFactory->create();
        $extensionAttributes->setShippingTypes($order->getShippingTypes());
        $extensionAttributes->setResidential($order->getResidential());
        $extensionAttributes->setLiftgate($order->getLiftgate());
        $extensionAttributes->setDelivery($order->getDelivery());

        $order->setExtensionAttributes($extensionAttributes);

        return $order;
    }

    /**
     * After Get List plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $searchResult
     * @return OrderSearchResultInterface
     */
    public function afterGetList(OrderRepositoryInterface $subject, OrderSearchResultInterface $searchResult)
    {
        $orders = $searchResult->getItems();
        foreach ($orders as $order) {
            $this->afterGet($subject, $order);
        }
        return $searchResult;
    }

    /**
     * Before Save plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return array
     */
    public function beforeSave(OrderRepositoryInterface $subject, OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes();
        if ($extensionAttributes !== null) {
            $order->setShippingTypes($extensionAttributes->getShippingTypes());
            $order->setResidential($extensionAttributes->getResidential());
            $order->setLiftgate($extensionAttributes->getLiftgate());
            $order->setDelivery($extensionAttributes->getDelivery());
        }

        return [$order];
    }
}

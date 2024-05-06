<?php
namespace Kitchen\Order\Model;

use Kitchen\Order\Api\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItemCollectionFactory;
use Magento\Framework\Exception\CouldNotRetrieveException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;

class Order implements OrderInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var OrderItemCollectionFactory
     */
    protected $orderItemCollectionFactory;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    protected $searchCriteriaBuilderFactory;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemCollectionFactory $orderItemCollectionFactory,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemCollectionFactory = $orderItemCollectionFactory;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
    }

    /**
     * Retrieve order data filtered by selected order IDs.
     *
     * @param string $OrderIds
     * @return array
     */
    public function getUserData($OrderIds): array
    {
        try {
            if (empty($OrderIds)) {
                return ['success' => false, 'message' => 'No order IDs provided.'];
            }

            $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
            $searchCriteriaBuilder->addFilter('entity_id', $OrderIds, 'in');
            $searchCriteria = $searchCriteriaBuilder->create();

            $orders = $this->orderRepository->getList($searchCriteria)->getItems();
            $orderData = [];
            foreach ($orders as $order) {
                $orderData[] = $order->getData();
            }
            return ['success' => true, 'data' => $orderData];
        } catch (CouldNotRetrieveException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

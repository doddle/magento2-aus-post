<?php
declare(strict_types=1);

namespace Doddle\Returns\Observer;

use Doddle\Returns\Api\Data\OrderQueueInterface;
use Doddle\Returns\Api\Data\OrderQueueInterfaceFactory;
use Doddle\Returns\Api\OrderQueueRepositoryInterface;
use Doddle\Returns\Model\OrderQueue;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\Order;

class AfterUpdateOrder implements ObserverInterface
{
    /** @var OrderQueueInterfaceFactory */
    private $orderQueueFactory;

    /** @var OrderQueueRepositoryInterface */
    private $orderQueueRepository;

    /**
     * @param OrderQueueInterfaceFactory $orderQueueFactory
     * @param OrderQueueRepositoryInterface $orderQueueRepository
     */
    public function __construct(
        OrderQueueInterfaceFactory $orderQueueFactory,
        OrderQueueRepositoryInterface $orderQueueRepository
    ) {
        $this->orderQueueFactory = $orderQueueFactory;
        $this->orderQueueRepository = $orderQueueRepository;
    }

    /**
     * Observer function called after order address update
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer): void
    {
        $orderId = $observer->getOrderId();

        $this->queueUpdateOrder($orderId);
    }

    /**
     * Queue up the order for update
     *
     * @param $orderId
     */
    private function queueUpdateOrder($orderId): void
    {
        /** @var OrderQueue $orderQueue */
        $orderQueue = $this->orderQueueFactory->create();

        // Try to load existing queue item
        $orderQueue->load($orderId, OrderQueueInterface::ORDER_ID);

        // Update fields to cancel the item
        $orderQueue->setData(OrderQueueInterface::ORDER_ID, $orderId);
        $orderQueue->setData(OrderQueueInterface::STATUS, OrderQueueInterface::STATUS_UPDATE);
        $orderQueue->setData(OrderQueueInterface::FAIL_COUNT, 0);

        $this->orderQueueRepository->save($orderQueue);
    }
}

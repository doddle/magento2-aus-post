<?php
declare(strict_types=1);

namespace AustraliaPost\Returns\Model;

use Magento\Wishlist\Model\WishlistFactory;
use AustraliaPost\Returns\Api\OrderQueueRepositoryInterface;
use AustraliaPost\Returns\Api\Data\OrderQueueInterface;

class OrderQueueRepository implements OrderQueueRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function save(OrderQueueInterface $orderQueue): OrderQueueInterface
    {
        $orderQueue->save($orderQueue);
        return $orderQueue;
    }
}

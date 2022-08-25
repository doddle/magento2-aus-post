<?php
namespace AustraliaPost\Returns\Api;

use AustraliaPost\Returns\Api\Data\OrderQueueInterface;

interface OrderQueueRepositoryInterface
{
    /**
     * Save order queue entity
     *
     * @param \AustraliaPost\Returns\Api\Data\OrderQueueInterface $orderQueue
     * @return \AustraliaPost\Returns\Api\Data\OrderQueueInterface
     */
    public function save(OrderQueueInterface $orderQueue);
}

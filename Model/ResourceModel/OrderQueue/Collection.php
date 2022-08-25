<?php
namespace AustraliaPost\Returns\Model\ResourceModel\OrderQueue;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AustraliaPost\Returns\Model\OrderQueue;
use AustraliaPost\Returns\Model\ResourceModel\OrderQueue as OrderQueueResource;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(OrderQueue::class, OrderQueueResource::class);
    }
}

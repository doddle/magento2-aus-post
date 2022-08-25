<?php
declare(strict_types=1);

namespace AustraliaPost\Returns\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use AustraliaPost\Returns\Api\Data\OrderQueueInterface;
use AustraliaPost\Returns\Helper\Data as DataHelper;

class OrderQueue extends AbstractDb
{
    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(DataHelper::DB_TABLE_ORDER_QUEUE, OrderQueueInterface::ID);
    }

    /**
     * Before save hook to set updated at date
     *
     * @param AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(AbstractModel $object): self
    {
        if ($object->hasDataChanges()) {
            $object->unsetData(OrderQueueInterface::UPDATED_AT);
        }

        return parent::_beforeSave($object);
    }
}

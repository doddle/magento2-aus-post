<?php
namespace AustraliaPost\Returns\Api\Data;

interface OrderQueueInterface
{
    public const ID               = 'sync_id';
    public const ORDER_ID         = 'order_id';
    public const STATUS           = 'status';
    public const FAIL_COUNT       = 'fail_count';
    public const CREATED_AT       = 'created_at';
    public const UPDATED_AT       = 'updated_at';
    public const STATUS_PENDING   = 'pending';
    public const STATUS_SYNCHED   = 'synched';
    public const STATUS_FAILED    = 'failed';
    public const STATUS_CANCEL    = 'cancel';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_UPDATE    = 'update';
    public const STATUS_UPDATED   = 'updated';

    /**
     * Get entity ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set entity ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Magento order ID
     *
     * @return int
     */
    public function getOrderId();

    /**
     * Set Magento order ID
     *
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * Get API sync status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set API sync status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get sync fail count
     *
     * @return int
     */
    public function getFailCount();

    /**
     * Set sync fail count
     *
     * @param int $failCount
     * @return $this
     */
    public function setFailCount($failCount);

    /**
     * Get created at date
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at date
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}

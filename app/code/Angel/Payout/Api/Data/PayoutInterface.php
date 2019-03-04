<?php


namespace Angel\Payout\Api\Data;

interface PayoutInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CUSTOMER_EMAIL = 'customer_email';
    const AMOUNT = 'amount';
    const SECURITY_PASS = 'security_pass';
    const UPDATED_AT = 'updated_at';
    const STATUS = 'status';
    const PHONE_NUMBER = 'phone_number';
    const PAYOUT_ID = 'payout_id';
    const CREDIT_TRANSACTION_ID = 'credit_transaction_id';
    const PAY_AT = 'pay_at';
    const PICKED_AT = 'picked_at';
    const CUSTOMER_ID = 'customer_id';
    const CURRENCY = 'currency';
    const CREATED_AT = 'created_at';
    const LOCATION_ID = 'location_id';
    const COMMENT = 'comment';
    const ADMIN_ID = 'admin_id';

    /**
     * Get payout_id
     * @return string|null
     */
    public function getPayoutId();

    /**
     * Set payout_id
     * @param string $payoutId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPayoutId($payoutId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Payout\Api\Data\PayoutExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Angel\Payout\Api\Data\PayoutExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Payout\Api\Data\PayoutExtensionInterface $extensionAttributes
    );

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Set customer_email
     * @param string $customerEmail
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Get phone_number
     * @return string|null
     */
    public function getPhoneNumber();

    /**
     * Set phone_number
     * @param string $phoneNumber
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setAmount($amount);

    /**
     * Get currency
     * @return string|null
     */
    public function getCurrency();

    /**
     * Set currency
     * @param string $currency
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCurrency($currency);

    /**
     * Get security_pass
     * @return string|null
     */
    public function getSecurityPass();

    /**
     * Set security_pass
     * @param string $securityPass
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setSecurityPass($securityPass);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get location_id
     * @return string|null
     */
    public function getLocationId();

    /**
     * Set location_id
     * @param string $locationId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setLocationId($locationId);

    /**
     * Get picked_at
     * @return string|null
     */
    public function getPickedAt();

    /**
     * Set picked_at
     * @param string $pickedAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPickedAt($pickedAt);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setComment($comment);

    /**
     * Get pay_at
     * @return string|null
     */
    public function getPayAt();

    /**
     * Set pay_at
     * @param string $payAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPayAt($payAt);

    /**
     * Get admin_id
     * @return string|null
     */
    public function getAdminId();

    /**
     * Set admin_id
     * @param string $adminId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setAdminId($adminId);

    /**
     * Get credit_transaction_id
     * @return string|null
     */
    public function getCreditTransactionId();

    /**
     * Set credit_transaction_id
     * @param string $creditTransactionId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCreditTransactionId($creditTransactionId);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setStatus($status);
}

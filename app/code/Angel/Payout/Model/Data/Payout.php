<?php


namespace Angel\Payout\Model\Data;

use Angel\Payout\Api\Data\PayoutInterface;

class Payout extends \Magento\Framework\Api\AbstractExtensibleObject implements PayoutInterface
{

    /**
     * Get payout_id
     * @return string|null
     */
    public function getPayoutId()
    {
        return $this->_get(self::PAYOUT_ID);
    }

    /**
     * Set payout_id
     * @param string $payoutId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPayoutId($payoutId)
    {
        return $this->setData(self::PAYOUT_ID, $payoutId);
    }

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Payout\Api\Data\PayoutExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Angel\Payout\Api\Data\PayoutExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Payout\Api\Data\PayoutExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail()
    {
        return $this->_get(self::CUSTOMER_EMAIL);
    }

    /**
     * Set customer_email
     * @param string $customerEmail
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * Get phone_number
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->_get(self::PHONE_NUMBER);
    }

    /**
     * Set phone_number
     * @param string $phoneNumber
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPhoneNumber($phoneNumber)
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount()
    {
        return $this->_get(self::AMOUNT);
    }

    /**
     * Set amount
     * @param string $amount
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * Get currency
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->_get(self::CURRENCY);
    }

    /**
     * Set currency
     * @param string $currency
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    /**
     * Get security_pass
     * @return string|null
     */
    public function getSecurityPass()
    {
        return $this->_get(self::SECURITY_PASS);
    }

    /**
     * Set security_pass
     * @param string $securityPass
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setSecurityPass($securityPass)
    {
        return $this->setData(self::SECURITY_PASS, $securityPass);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get location_id
     * @return string|null
     */
    public function getLocationId()
    {
        return $this->_get(self::LOCATION_ID);
    }

    /**
     * Set location_id
     * @param string $locationId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setLocationId($locationId)
    {
        return $this->setData(self::LOCATION_ID, $locationId);
    }

    /**
     * Get picked_at
     * @return string|null
     */
    public function getPickedAt()
    {
        return $this->_get(self::PICKED_AT);
    }

    /**
     * Set picked_at
     * @param string $pickedAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPickedAt($pickedAt)
    {
        return $this->setData(self::PICKED_AT, $pickedAt);
    }

    /**
     * Get comment
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT);
    }

    /**
     * Set comment
     * @param string $comment
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Get pay_at
     * @return string|null
     */
    public function getPayAt()
    {
        return $this->_get(self::PAY_AT);
    }

    /**
     * Set pay_at
     * @param string $payAt
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setPayAt($payAt)
    {
        return $this->setData(self::PAY_AT, $payAt);
    }

    /**
     * Get admin_id
     * @return string|null
     */
    public function getAdminId()
    {
        return $this->_get(self::ADMIN_ID);
    }

    /**
     * Set admin_id
     * @param string $adminId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setAdminId($adminId)
    {
        return $this->setData(self::ADMIN_ID, $adminId);
    }

    /**
     * Get credit_transaction_id
     * @return string|null
     */
    public function getCreditTransactionId()
    {
        return $this->_get(self::CREDIT_TRANSACTION_ID);
    }

    /**
     * Set credit_transaction_id
     * @param string $creditTransactionId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setCreditTransactionId($creditTransactionId)
    {
        return $this->setData(self::CREDIT_TRANSACTION_ID, $creditTransactionId);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Angel\Payout\Api\Data\PayoutInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}

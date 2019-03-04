<?php


namespace Angel\Payout\Api\Data;

interface PayoutSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Payout list.
     * @return \Angel\Payout\Api\Data\PayoutInterface[]
     */
    public function getItems();

    /**
     * Set customer_id list.
     * @param \Angel\Payout\Api\Data\PayoutInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

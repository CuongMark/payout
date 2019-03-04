<?php


namespace Angel\Payout\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PayoutRepositoryInterface
{

    /**
     * Save Payout
     * @param \Angel\Payout\Api\Data\PayoutInterface $payout
     * @return \Angel\Payout\Api\Data\PayoutInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Angel\Payout\Api\Data\PayoutInterface $payout
    );

    /**
     * Retrieve Payout
     * @param string $payoutId
     * @return \Angel\Payout\Api\Data\PayoutInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($payoutId);

    /**
     * Retrieve Payout matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Angel\Payout\Api\Data\PayoutSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Payout
     * @param \Angel\Payout\Api\Data\PayoutInterface $payout
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Angel\Payout\Api\Data\PayoutInterface $payout
    );

    /**
     * Delete Payout by ID
     * @param string $payoutId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($payoutId);
}

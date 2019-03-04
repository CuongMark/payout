<?php


namespace Angel\Payout\Model\ResourceModel\Payout;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Angel\Payout\Model\Payout::class,
            \Angel\Payout\Model\ResourceModel\Payout::class
        );
    }
}

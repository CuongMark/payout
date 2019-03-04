<?php


namespace Angel\Payout\Model\ResourceModel;

class Payout extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('angel_payout_payout', 'payout_id');
    }
}

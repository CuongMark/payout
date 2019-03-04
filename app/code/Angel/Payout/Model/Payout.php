<?php


namespace Angel\Payout\Model;

use Magento\Framework\Api\DataObjectHelper;
use Angel\Payout\Api\Data\PayoutInterface;
use Angel\Payout\Api\Data\PayoutInterfaceFactory;

class Payout extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'angel_payout_payout';
    protected $payoutDataFactory;

    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PayoutInterfaceFactory $payoutDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Angel\Payout\Model\ResourceModel\Payout $resource
     * @param \Angel\Payout\Model\ResourceModel\Payout\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PayoutInterfaceFactory $payoutDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Angel\Payout\Model\ResourceModel\Payout $resource,
        \Angel\Payout\Model\ResourceModel\Payout\Collection $resourceCollection,
        array $data = []
    ) {
        $this->payoutDataFactory = $payoutDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve payout model with payout data
     * @return PayoutInterface
     */
    public function getDataModel()
    {
        $payoutData = $this->getData();
        
        $payoutDataObject = $this->payoutDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $payoutDataObject,
            $payoutData,
            PayoutInterface::class
        );
        
        return $payoutDataObject;
    }
}

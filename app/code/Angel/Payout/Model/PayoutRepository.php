<?php


namespace Angel\Payout\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Angel\Payout\Model\ResourceModel\Payout as ResourcePayout;
use Magento\Framework\Exception\NoSuchEntityException;
use Angel\Payout\Api\Data\PayoutSearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Angel\Payout\Api\Data\PayoutInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Angel\Payout\Model\ResourceModel\Payout\CollectionFactory as PayoutCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Angel\Payout\Api\PayoutRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class PayoutRepository implements PayoutRepositoryInterface
{

    protected $payoutCollectionFactory;

    protected $dataObjectHelper;

    private $collectionProcessor;

    protected $payoutFactory;

    protected $dataObjectProcessor;

    protected $dataPayoutFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;


    /**
     * @param ResourcePayout $resource
     * @param PayoutFactory $payoutFactory
     * @param PayoutInterfaceFactory $dataPayoutFactory
     * @param PayoutCollectionFactory $payoutCollectionFactory
     * @param PayoutSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePayout $resource,
        PayoutFactory $payoutFactory,
        PayoutInterfaceFactory $dataPayoutFactory,
        PayoutCollectionFactory $payoutCollectionFactory,
        PayoutSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->payoutFactory = $payoutFactory;
        $this->payoutCollectionFactory = $payoutCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPayoutFactory = $dataPayoutFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Angel\Payout\Api\Data\PayoutInterface $payout
    ) {
        /* if (empty($payout->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $payout->setStoreId($storeId);
        } */
        
        $payoutData = $this->extensibleDataObjectConverter->toNestedArray(
            $payout,
            [],
            \Angel\Payout\Api\Data\PayoutInterface::class
        );
        
        $payoutModel = $this->payoutFactory->create()->setData($payoutData);
        
        try {
            $this->resource->save($payoutModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the payout: %1',
                $exception->getMessage()
            ));
        }
        return $payoutModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($payoutId)
    {
        $payout = $this->payoutFactory->create();
        $this->resource->load($payout, $payoutId);
        if (!$payout->getId()) {
            throw new NoSuchEntityException(__('Payout with id "%1" does not exist.', $payoutId));
        }
        return $payout->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->payoutCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Angel\Payout\Api\Data\PayoutInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Angel\Payout\Api\Data\PayoutInterface $payout
    ) {
        try {
            $payoutModel = $this->payoutFactory->create();
            $this->resource->load($payoutModel, $payout->getPayoutId());
            $this->resource->delete($payoutModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Payout: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($payoutId)
    {
        return $this->delete($this->getById($payoutId));
    }
}

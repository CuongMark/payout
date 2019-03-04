<?php


namespace Angel\Payout\Model\Payout;

use Angel\Payout\Model\Payout;
use Angel\Payout\Model\ResourceModel\Payout\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $dataPersistor;

    /**
     * @var \Angel\Payout\Model\ResourceModel\Payout\Collection
     */
    protected $collection;

    protected $loadedData;
    private $registry;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        Registry $registry,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->registry = $registry;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $model->unsetData('security_pass');
            $this->loadedData[$model->getId()] = $model->getData();
        }
        $data = $this->dataPersistor->get('angel_payout_payout');

        if (!empty($data)) {
            /** @var Payout $model */
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $model->unsetData('security_pass');
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('angel_payout_payout');
        }
        
        return $this->loadedData;
    }
}

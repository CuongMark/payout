<?php


namespace Angel\Payout\Block\Index;

use Angel\Payout\Model\Data\Payout;
use Angel\Payout\Model\Payout\Status;
use Angel\Payout\Model\ResourceModel\Payout\Collection;
use Angel\Payout\Model\ResourceModel\Payout\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    private $priceCurrency;
    private $payoutCollectionFactory;
    private $customerSession;
    /**
     * @var Collection
     */
    protected $payoutCollection;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        PriceCurrencyInterface $priceCurrency,
        CollectionFactory $payoutCollectionFactory,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->priceCurrency = $priceCurrency;
        $this->payoutCollectionFactory = $payoutCollectionFactory;
        $this->customerSession = $customerSession;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Payout Requests'));
        parent::_prepareLayout();
        if ($this->getPayoutRequests()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'sales.payouts.pager'
            )->setCollection(
                $this->getPayoutRequests()
            );
            $this->setChild('pager', $pager);
            $this->getPayoutRequests()->load();
        }
        return $this;
    }


    /**
     * @return Collection
     */
    public function getPayoutRequests()
    {
        if (!$this->payoutCollection) {
            /** @var Collection $payoutCollection */
            $payoutCollection = $this->payoutCollectionFactory->create();
            $payoutCollection->addFieldToFilter('customer_id', $this->customerSession->getCustomerId());
            $payoutCollection->setOrder('payout_id');
            $this->payoutCollection = $payoutCollection;
        }
        return $this->payoutCollection;
    }


    /**
     * @param object $payout
     * @return string
     */
    public function getCancelUrl($payout)
    {
        return $this->getUrl('payout/index/cancel', ['id' => $payout->getId()]);
    }

    /**
     * @return string
     */
    public function getCreateRequestUrl()
    {
        return $this->getUrl('payout/index/create');
    }

    /**
     * Retrieve formated price
     *
     * @param float $value
     * @return string
     */
    public function formatPrice($value, $isHtml = true)
    {
        return $this->priceCurrency->format(
            $value,
            $isHtml,
            PriceCurrencyInterface::DEFAULT_PRECISION,
            1 //Todo getStore
        );
    }

    /**
     * @param Payout $payout
     * @return mixed
     */
    public function getStatusLabel($payout){
        $options = Status::getOptionArray();
        return $options[$payout->getStatus()];
    }
}

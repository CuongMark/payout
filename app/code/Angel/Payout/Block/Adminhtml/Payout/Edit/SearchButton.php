<?php


namespace Angel\Payout\Block\Adminhtml\Payout\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SearchButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Search'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}

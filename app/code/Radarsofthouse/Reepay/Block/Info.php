<?php

namespace Radarsofthouse\Reepay\Block;

use Magento\Payment\Block\Info as MagentoPaymentInfo;

/**
 * Class Info
 *
 * @package Radarsofthouse\Reepay\Block
 */
class Info extends MagentoPaymentInfo
{
    /**
     * Override Magento\Payment\Block\Info
     *
     * @param null|\Magento\Framework\DataObject|array $transport
     * @return \Magento\Framework\DataObject $transport
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        $transport = parent::_prepareSpecificInformation($transport);
        $data = [];
        if ($additionalInformation = $this->getInfo()->getAdditionalInformation()) {
            if (!empty($additionalInformation['raw_details_info']['source_card_type'])) {
                $data['Card type'] = $additionalInformation['raw_details_info']['source_card_type'];
            }
            if (!empty($additionalInformation['raw_details_info']['source_masked_card'])) {
                $data['Card'] = $additionalInformation['raw_details_info']['source_masked_card'];
            }
            if (!empty($additionalInformation['raw_details_info']['source_exp_date'])) {
                $data['Exp date'] = $additionalInformation['raw_details_info']['source_exp_date'];
            }
            if (!empty($additionalInformation['raw_details_info']['state'])) {
                $data['State'] = $additionalInformation['raw_details_info']['state'];
            }
        }

        return $transport->setData(array_merge($data, $transport->getData()));
    }
}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kitchen\Company\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * @api
 * @since 100.0.2
 */
class CustomPriceType extends AbstractSource
{
    /**
     * Options getter
     *
     * @return array
     */

     public function getAllOptions()
     {
         return [
            ['value' => '', 'label' => __('Select Price Type')],
            ['value' => 0, 'label' => __('Fixed Price')],
            ['value' => 1, 'label' => __('Discount Price')],
         ];
    }
}

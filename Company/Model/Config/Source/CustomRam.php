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
class CustomRam extends AbstractSource
{
    /**
     * Options getter
     *
     * @return array
     */

     public function getAllOptions()
     {
         return [
            ['value' => 0, 'label' => __('2 GB')],
            ['value' => 1, 'label' => __('4 GB')],
            ['value' => 2, 'label' => __('6 GB')],
            ['value' => 3, 'label' => __('8 GB')],
            ['value' => 4, 'label' => __('16 GB')],
            ['value' => 5, 'label' => __('32 GB')],
         ];
    }
}
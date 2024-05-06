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
class CustomStorage extends AbstractSource
{
    /**
     * Options getter
     *
     * @return array
     */

     public function getAllOptions()
     {
         return [
            ['value' => 0, 'label' => __('32 GB')],
            ['value' => 1, 'label' => __('64 GB')],
            ['value' => 2, 'label' => __('128 GB')],
            ['value' => 3, 'label' => __('256 GB')],
            ['value' => 4, 'label' => __('512 GB')],
            ['value' => 5, 'label' => __('1 TB')],
         ];
    }
}

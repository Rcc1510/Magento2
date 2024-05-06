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
class CustomBattery extends AbstractSource
{
    /**
     * Options getter
     *
     * @return array
     */

     public function getAllOptions()
     {
         return [
             ['value' => 0, 'label' => __('3000')],
             ['value' => 1, 'label' => __('4000')],
             ['value' => 2, 'label' => __('5000')],
             ['value' => 3, 'label' => __('6000')],
             ['value' => 4, 'label' => __('7000')],
         ];
    }
}
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
class CustomDisplay extends AbstractSource
{
    /**
     * Options getter
     *
     * @return array
     */

     public function getAllOptions()
     {
         return [
             ['value' => 0, 'label' => __('5.0')],
             ['value' => 1, 'label' => __('5.2')],
             ['value' => 2, 'label' => __('5.4')],
             ['value' => 3, 'label' => __('5.6')],
             ['value' => 4, 'label' => __('5.8')],
             ['value' => 5, 'label' => __('6.2')],
             ['value' => 6, 'label' => __('6.4')],
         ];
    }
}
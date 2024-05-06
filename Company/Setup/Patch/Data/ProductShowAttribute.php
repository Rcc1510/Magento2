<?php

declare(strict_types=1);

namespace Kitchen\Company\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class CreateCustomAttr for Create Custom Product Attribute using Data Patch.
 */
class ProductShowAttribute implements DataPatchInterface
{

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributes = [
            [
                'code' => 'simple_product_attributes',
                'label' => 'Simple Product',
                // Add other attribute options here
            ],
            [
                'code' => 'configurable_product_attributes',
                'label' => 'Configurable Product',
                // Add other attribute options here
            ],
            [
                'code' => 'group_product_attributes',
                'label' => 'Group Product',
                // Add other attribute options here
            ],
            [
                'code' => 'virtual_product_attributes',
                'label' => 'Virtual Product',
                // Add other attribute options here
            ],
            [
                'code' => 'bundle_product_attributes',
                'label' => 'Bundle Product',
                // Add other attribute options here
            ],
            [
                'code' => 'downloadable_product_attributes',
                'label' => 'Downloadable Product',
                // Add other attribute options here
            ],
            // Add more attributes as needed
        ];

        foreach ($attributes as $attribute) {
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $attribute['code'],
                [
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => $attribute['label'],
                    'input' => 'text',
                    'class' => '',
                    'source' => '',
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => true,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => '',
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}

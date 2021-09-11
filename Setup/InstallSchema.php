<?php

namespace Magepow\Promotionbar\Setup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)

    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('promotionbar_management')){
        $table = $installer->getConnection()
            ->newTable($installer->getTable('promotionbar_management'));
        $table->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'ENTITY ID'
        ) ->addColumn(
                'name',
                 Table::TYPE_TEXT,
                 '2M',
                  [],
                 'Name'
            )
         ->addColumn(
               'category',
                 Table::TYPE_TEXT,
                   '2M',
                  [],
                 'category'
            )
            ->addColumn(
               'stores',
                 Table::TYPE_TEXT,
                '2M',
                  ['nullable' => false],
                 'stores view'
            )
            ->addColumn(
                'customer_group',
                Table::TYPE_TEXT,
               '2M',
                  [],
               'customer group'
            )
            ->addColumn(
             'is_active',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'default' => '1',
                ],
                'Is Active status'
            )
            ->addColumn(
                'is_shown_on_productpage',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'default' => '1',
                ],
                'is_shown_on_productpage '
            )
            
            ->addColumn(
                 'display_onpage',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Display on page'
            )
            ->addColumn(
                 'display_page',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Display what page'
            )
            ->addColumn(
                 'position',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Position'
            )
            ->addColumn(
                 'promotionbar_info',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Promotion Bar Information'
            )->addColumn('conditions_serialized', Table::TYPE_TEXT, '2M', [], 
            'Conditions Serialized')
            ->addColumn('sort_order', Table::TYPE_INTEGER, null, [ 'nullable' => false], 
            'Sort Order')
            ->addColumn(
                'start_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
   				 null,
   				 ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
    			'Start At'
            )
            ->addColumn(
                'end_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
   				 null,
   				 ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'End At'
            );
             $installer->getConnection()->createTable($table);
             $installer->getConnection()->addIndex(
                $installer->getTable('promotionbar_management'),
                $setup->getIdxName(
                    $installer->getTable('promotionbar_management'),
                    ['name', 'promotionbar_info'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'promotionbar_info'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        
        }
       
        $installer->endSetup();
       
        
    }
}

<?php
namespace Magepow\Promotionbar\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
	  public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
    	$setup->startSetup();
        $tableName = $setup->getTable('promotionbar_management');
            if (version_compare($context->getVersion(), '2.0.0', '<')) {
            	if ($setup->getConnection()->isTableExists($tableName) == true){
                $connection = $setup->getConnection();
                $connection->addColumn(
                	$setup->getTable($tableName),'display_page',['type' => Table::TYPE_TEXT,
                        'length' => '2M',
                        'nullable' => true,
                         'comment'=>'Page Display']
                );

            }
            }  if (version_compare($context->getVersion(), '2.1.0', '<')) {
                if ($setup->getConnection()->isTableExists($tableName) == true){
                $connection = $setup->getConnection();
                $connection->addColumn(
                    $setup->getTable($tableName),'page_option',['type' => Table::TYPE_TEXT,
                        'length' => '2M',
                        'nullable' => true,
                         'comment'=>'Page option']
                );

            }
            }
            if (version_compare($context->getVersion(), '2.2.0', '<')) {
                if ($setup->getConnection()->isTableExists($tableName) == true){
                $connection = $setup->getConnection();
                $connection->addColumn(
                    $setup->getTable($tableName),'category',['type' => Table::TYPE_TEXT,
                        'length' => '2M',
                        'nullable' => true,
                         'comment'=>'Category']
                );

            }
            }
             

          

}
}
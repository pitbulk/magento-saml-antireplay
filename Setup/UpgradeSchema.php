<?php

namespace Pitbulk\Antireplay\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;


class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {	
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $tableName = $setup->getTable('saml2_assertion');	
    	    if ($setup->getConnection()->isTableExists($tableName) != true) {
                $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                   'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'assertion_id',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Assertion ID'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->setComment('Saml2 - Processed Assertions');
	        $setup->getConnection()->createTable($table);
            }
        }
        $setup->endSetup();
    }
}

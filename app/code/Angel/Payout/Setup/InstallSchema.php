<?php


namespace Angel\Payout\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_angel_payout_payout = $setup->getConnection()->newTable($setup->getTable('angel_payout_payout'));

        $table_angel_payout_payout->addColumn(
            'payout_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_angel_payout_payout->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => False],
            'Customer Id'
        );

        $table_angel_payout_payout->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            256,
            ['nullable' => False],
            'Customer Email'
        );

        $table_angel_payout_payout->addColumn(
            'phone_number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Customer Phone Number'
        );

        $table_angel_payout_payout->addColumn(
            'amount',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            '12,4',
            ['nullable' => False,'precision' => 12,'scale' => 4],
            'Amount'
        );

        $table_angel_payout_payout->addColumn(
            'currency',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => False],
            'Currency'
        );

        $table_angel_payout_payout->addColumn(
            'security_pass',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => False],
            '512'
        );

        $table_angel_payout_payout->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => False, 'default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Created At'
        );

        $table_angel_payout_payout->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => False, 'default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'), 'on_updated' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Updated At'
        );

        $table_angel_payout_payout->addColumn(
            'location_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Location Id'
        );

        $table_angel_payout_payout->addColumn(
            'picked_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Picked at'
        );

        $table_angel_payout_payout->addColumn(
            'comment',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Comment'
        );

        $table_angel_payout_payout->addColumn(
            'pay_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Pay Out at'
        );

        $table_angel_payout_payout->addColumn(
            'admin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Admin Id'
        );

        $table_angel_payout_payout->addColumn(
            'credit_transaction_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Customer Credit Transaction Id'
        );

        $table_angel_payout_payout->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Status'
        );

        //Your install script

        $setup->getConnection()->createTable($table_angel_payout_payout);
    }
}

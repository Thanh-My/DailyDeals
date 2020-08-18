<?php
/**
* Copyright © 2016 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Tigren\DailyDeals\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
          /**
          * Create table 'greeting_message'
          */
          $table = $setup->getConnection()
              ->newTable($setup->getTable('tigren_daily_deals'))
              ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'product_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Product ID'
                    )
                    ->addColumn(
                        'status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        1,
                        [],
                        'Status'
                    )
                    ->addColumn(
                        'start_date',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                        null,
                        [],
                        'Start Date'
                    )
                    ->addColumn(
                        'start_time',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Start Time'
                    )->addColumn(
                        'end_date',
                        \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                        null,
                        [],
                        'End Date'
                    )->addColumn(
                        'end_time',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'End Time'
                    )->addColumn(
                        'deal_price',
                        \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                        10,
                        [],
                        'Deal Price'
                    )->addColumn(
                        'deal_qty',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        4,
                        [],
                        'Deal Quantity'
                    )->setComment('Daily Deals Table');
                $installer->getConnection()->createTable($table);
          $setup->getConnection()->createTable($table);
      }
}
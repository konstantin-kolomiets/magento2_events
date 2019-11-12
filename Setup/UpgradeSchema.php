<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2019-11-01
 * Time: 17:38
 */

namespace Vaimo\Events\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Vaimo\Events\Api\Data\EventSubscriptionsInterface;

/**
 * Class UpgradeSchema
 * @package Vaimo\Events\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.2','<')) {

            $setup->startSetup();
            $tableSubscriptions = $setup->getConnection()->newTable(
                $setup->getTable( EventSubscriptionsInterface::TABLE_NAME)
            )->addColumn(
                EventSubscriptionsInterface::FIELD_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
                'Fun order ID'
            )->addColumn(
                EventSubscriptionsInterface::FIELD_EVENTS_ID,
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false
                ],
                'event id'
            )->addColumn(
                EventSubscriptionsInterface::FIELD_NAME,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'name'
            )->addColumn(
                EventSubscriptionsInterface::FIELD_PHONE,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'phone'
            )->addColumn(
                EventSubscriptionsInterface::FIELD_STATUS,
                Table::TYPE_BOOLEAN,
                1, ['default' => 1 ,'nullable' => false],
                'status'
            )->setComment(
                'Fun order table '
            );
            $setup->getConnection()->createTable($tableSubscriptions);
            $setup->endSetup();
        }
    }
}

<?php
namespace Alex\TestProject\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;

        $table = $installer->getConnection()->newTable(
            $installer->getTable(\Alex\TestProject\Model\Question::TABLE_NAME)
        )
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
            'Question Id'
        )
        ->addColumn(
            'name',
            Table::TYPE_TEXT,
            64,
            [],
            'User Name'
        )
        ->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            [],
            'User email'
        )
        ->addColumn(
            'telephone',
            Table::TYPE_TEXT,
            255,
            [],
            'Phone'
        )
        ->addColumn(
            'comment',
            Table::TYPE_TEXT,
            500,
            [],
            'Question'
        )
        ->addColumn(
            'is_answered',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'default' => '0'
            ],
            'Answer status'
        )
        ->setComment(
            'Questions from contact form
        ');

        $installer->getConnection()->createTable($table);
    }
}
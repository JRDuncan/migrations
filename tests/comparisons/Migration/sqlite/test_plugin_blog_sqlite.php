<?php
use Migrations\AbstractMigration;

class TestPluginBlogSqlite extends AbstractMigration
{
    public function up()
    {

        $this->table('articles')
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('note', 'string', [
                'default' => '7.4',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('counter', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'product_id',
                ]
            )
            ->addIndex(
                [
                    'category_id',
                ]
            )
            ->addIndex(
                [
                    'title',
                ]
            )
            ->create();

        $this->table('categories')
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'slug',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('parts')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('number', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
            ])
            ->create();

        $this->table('articles')
            ->addForeignKey(
                'product_id',
                'products',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'category_id',
                'categories',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('articles')
            ->dropForeignKey(
                'product_id'
            )
            ->dropForeignKey(
                'category_id'
            )->save();

        $this->table('articles')->drop()->save();
        $this->table('categories')->drop()->save();
        $this->table('parts')->drop()->save();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('categories', [
            'primary_key' => 'id'
        ]);

        $table
            ->addColumn('parent_id', 'integer', [
                'null' => true,
            ])
            ->addColumn('name', 'string', [
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'null' => true
            ])
            ->addColumn('modified', 'datetime', [
                'null' => true,
            ])
            ->create();
    }
}

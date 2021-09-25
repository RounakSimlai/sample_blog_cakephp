<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateArticlesTable extends AbstractMigration
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
        $table = $this->table('articles',[
            'primary_key'=>'id'
        ]);

        $table->addColumn('title', 'string', [
            'null' => false,
        ])
            ->addColumn('body', 'text', [
            'null' => false,
        ])

            ->addColumn('category_id', 'integer', [
            'null' => false,
        ])
            ->addColumn('user_id', 'integer', [
            'null' => false,
        ])
            ->addColumn('created', 'datetime', [
            'null' => true,
        ])

            ->addColumn('modified', 'datetime', [
            'null' => true,
        ])
        ->create();
    }
}

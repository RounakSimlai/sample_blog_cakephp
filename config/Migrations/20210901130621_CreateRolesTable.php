<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRolesTable extends AbstractMigration
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
        $table = $this->table('roles',[
            'id' => false,
            'primary_key' => 'id'
        ]);
        $table
            ->addColumn('id', 'integer')
            ->addColumn('title', \Phinx\Util\Literal::from('citext'), [
                'null' => false
            ])
            ->addColumn('description', 'string', [
                'null' => false
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
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
        $table = $this->table('users', [
            'primary_key' => 'id',
        ]);
        $table
            ->addColumn('first_name', \Phinx\Util\Literal::from('citext'), [
                'null' => false
            ])
            ->addColumn('last_name', \Phinx\Util\Literal::from('citext'), [
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'null' => false
            ])
            ->addColumn('password', 'string', [
                'null' => false
            ])
            ->addColumn('role_id', 'integer', [
                'null' => false
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex('email', [
                'unique' => true,
                'name' => 'uniq_email'
            ])
            ->create();
    }
}

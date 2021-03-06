<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $time = (new \Cake\I18n\Time());
        $data = [
            [
                'id'=>'1',
                'title'=>'Admin',
                'description'=>'Has access to everything',
            ],
            [
                'id'=>'2',
                'title'=>'Author',
                'description'=>'Has access to their own articles',
            ],
        ];

        $table = $this->table('roles');
        $table->insert($data)->save();
    }
}

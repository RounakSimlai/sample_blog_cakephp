<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use \Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
        $hash = new DefaultPasswordHasher();
        $data = [
            [
            'id'=>'1',
            'first_name'=>'App',
            'last_name'=>'Admin',
            'email'=>'admin@domain.com',
            'password'=>$hash->hash('admin123'),
            'role_id'=>'1',
            'image'=>'noPic.png',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}

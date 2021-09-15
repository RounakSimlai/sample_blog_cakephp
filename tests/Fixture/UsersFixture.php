<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\I18n\Time;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    const ID = '7ef23bca-8045-4538-9d69-3f1841d3edfb';

    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'first_name' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'last_name' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'email' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'password' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'role_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => 6],
        'modified' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => 6],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'uniq_email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $time = new Time();
        $this->records = [
            [
                'id' => self::ID ,
                'first_name' => 'Test',
                'last_name' => 'User',
                'email'=> 'testuser@domain.com',
                'password' => 'test',
                'role_id' => RolesFixture::ID ,
                'created' => $time,
                'modified' => $time,
            ],
        ];
        parent::init();
    }
}

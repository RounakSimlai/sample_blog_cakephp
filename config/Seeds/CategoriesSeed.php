<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Categories seed.
 */
class CategoriesSeed extends AbstractSeed
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
                'id' => '1',
                'parent_id' => null,
                'name' => 'Category 1',
                'description' => 'Category Description 1',
                'created' => $time,
                'modified' => $time,
            ],
            [
                'id' => '2',
                'parent_id' => null,
                'name' => 'Category 2',
                'description' => 'Category Description 2',
                'created' => $time,
                'modified' => $time,
            ],

        ];

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}

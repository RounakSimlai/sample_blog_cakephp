<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Model\Table\UsersTable;
use App\Test\Fixture\ArticlesFixture;
use App\Test\Fixture\CategoriesFixture;
use App\Test\Fixture\UsersFixture;
use Cake\TestSuite\IntegrationTestTrait;
use \Cake\TestSuite\TestCase;
use Cake\Utility\Text;

/**
 * Class ArticlesControllerTest
 *
 * @property UsersTable $Users
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    const DUMMY_ID = '74a076ba-6699-4d96-b357-6d9bb43bd16d';
    protected function _login()
    {
        $identity = $this->Users->get(UsersFixture::ID);
        $this->session([
            'Auth' => $identity,
        ]);
    }

    protected $fixtures = [
        'app.Articles',
        'app.Categories',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        /** @var UsersTable $users */
        $users = $this->getTableLocator()->get('Users', $config);
        $this->Users = $users;
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }


    /**
     * @return void
     */
    public function testIndex()
    {
        $this->get('/articles');
        $this->assertResponseSuccess();
        // More asserts.
    }

    /**
     * @return void
     */
    public function testAdd()
    {
        $this->_login();
        $this->post('/articles/add', [
            'title' => 'Cool Title',
            'body' => 'Cool Body',
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseSuccess();
        $this->assertResponseCode(200);
    }

    /**
     * @return void
     */
    public function testAddNullTitle()
    {
        $this->_login();
        $this->post('/articles/add/', [
            'title' => null,
            'body' => 'Cool Body',
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    public function testAddNullBody()
    {
        $this->_login();
        $this->post('/articles/add/', [
            'title' => 'Cool Title',
            'body' => null,
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    public function testAddNullCategory()
    {
        $this->_login();
        $this->post('/articles/add/', [
            'title' => 'Cool Title',
            'body' => 'Cool Body',
            'category_id' => null,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    /**
     * @return void
     */
    public function testEdit()
    {
        $this->_login();
        $this->put('/articles/edit/' . ArticlesFixture::ID, [
            'title' => 'Cool Title',
            'body' => 'Cool Body',
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseSuccess();
        $this->assertResponseCode(200);
    }

    /**
     * @return void
     */
    public function testEditNullTitle()
    {
        $this->_login();
        $this->put('/articles/edit/' . ArticlesFixture::ID, [
            'title' => null,
            'body' => 'Cool Body',
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    public function testEditNullBody()
    {
        $this->_login();
        $this->put('/articles/edit/' . ArticlesFixture::ID, [
            'title' => 'Cool Title',
            'body' => null,
            'category_id' => CategoriesFixture::ID,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    public function testEditNullCategory()
    {
        $this->_login();
        $this->put('/articles/edit/' . ArticlesFixture::ID, [
            'title' => 'Cool Title',
            'body' => 'Cool Body',
            'category_id' => null,
        ]);
        $this->assertResponseError();
        $this->assertResponseCode(400);
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->_login();
        $this->delete('/articles/delete/' . ArticlesFixture::ID);
        $this->assertResponseSuccess();
        $this->assertResponseCode(200);
    }

    /**
     * @return void
     */
    public function testDeleteNotExistingId()
    {
        $this->_login();
        $this->delete('/articles/delete/'.self::DUMMY_ID);
        $this->assertResponseError();
        $this->assertResponseCode(404);
    }

}

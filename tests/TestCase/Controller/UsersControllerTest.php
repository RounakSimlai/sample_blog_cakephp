<?php

namespace App\Test\TestCase\Controller;

use App\Model\Table\UsersTable;
use App\Test\Fixture\UsersFixture;
use App\Test\Fixture\RolesFixture;
use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestTrait;
use \Cake\TestSuite\TestCase;

/**
 * Class ArticlesControllerTest
 *
 * @property UsersTable $Users
 */
class UsersControllerTest extends TestCase
{

    use IntegrationTestTrait;

    protected function _login()
    {
        $identity = $this->Users->get(UsersFixture::ID);
        $this->session([
            'Auth' => $identity,
        ]);
    }

    protected $fixtures = [
        'app.Users',
        'app.Roles',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        /** @var UsersTable $users */
        $users = $this->getTableLocator()->get('Users', $config);
        $this->Users = $users;
    }

    public function tearDown(): void
    {
        unset($this->Users);
        parent::tearDown();
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->post('/users/add/', [
            'first_name' => 'foo',
            'last_name' => 'bar',
            'email' => 'foobar@gmail.com',
            'password' => '123456',
            'role_id' => RolesFixture::ID,
        ]);
        $this->assertResponseSuccess();
    }

//    /**
//     * @return void
//     */
//    public function testAddFailed(): void
//    {
//        $this->_login();
//        $this->enableCsrfToken();
//        $this->enableSecurityToken();
//        $this->post('/users/add/', [
//            'first_name' => null,
//            'last_name' => null,
//            'email' => null,
//            'password' => null,
//            'role_id' => null,
//        ]);
//        $this->assertResponseCode(400);
//    }

    /**
     * @return void
     */
    public function testEdit()
    {
        $this->_login();
        $this->post('/users/edit/' . UsersFixture::ID, [
            'first_name' => 'Test3',
            'last_name' => 'User3',
            'email' => 'testuser3@domain.com',
            'password' => 'test2',
            'role_id' => RolesFixture::ID,
        ]);
        $this->assertResponseSuccess();
        $this->assertRedirect(Router::url([
            'action' => 'index',
        ]));

    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->_login();
        $this->post('/users/delete/' . UsersFixture::ID);
        $this->assertResponseSuccess();
        $this->assertRedirect(Router::url([
            'action' => 'index',
        ]));
    }

    /**
     * @return void
     */
}

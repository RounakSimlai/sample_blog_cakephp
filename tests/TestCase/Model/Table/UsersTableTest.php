<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use App\Test\Fixture\RolesFixture;
use App\Test\Fixture\UsersFixture;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 * @property UsersTable $Users
 */
class UsersTableTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.Roles',
    ];

    private function _data(): array
    {
        return [
            'id' => UsersFixture::ID,
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'testuser@domain.com',
            'password' => 'test',
            'role_id' => RolesFixture::ID,
            'created' => 1630503492,
            'modified' => 1630503492,
        ];
    }


    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
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
     * Test initialize method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::initialize()
     */
    public function testInitialize(): void
    {
        $this->assertSame('users', $this->Users->getTable());
        $this->assertSame('id', $this->Users->getDisplayField());
        $this->assertSame('id', $this->Users->getPrimaryKey());
        $this->assertTrue($this->Users->hasBehavior('Timestamp'));
        $this->assertTrue($this->Users->hasAssociation('Roles'));
        $this->assertTrue($this->Users->hasAssociation('Articles'));
        $this->assertInstanceOf(BelongsTo::class, $this->Users->getAssociation('Roles'));
        $this->assertInstanceOf(HasMany::class, $this->Users->getAssociation('Articles'));
    }

    /**
     * Test to check the first name field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultFirstNameRequiredPresence(): void
    {
        $data = $this->_data();
        unset($data['first_name']);
        $data['email'] = 'testuser2@domain.com';
//        print_r($data);
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('first_name', $errors);
        $this->assertArrayHasKey('_required', $errors['first_name']);
    }

    /**
     * Test to check the first name field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultFirstNameNotEmpty(): void
    {
        $data = $this->_data();
        $data['first_name'] = null;
        $data['email'] = 'testuser2@domain.com';
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('first_name', $errors);
        $this->assertArrayHasKey('_empty', $errors['first_name']);
    }

    /**
     * Test to check the last name field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultLastNameRequiredPresence(): void
    {
        $data = $this->_data();
        unset($data['last_name']);
        $data['email'] = 'testuser2@domain.com';
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('last_name', $errors);
        $this->assertArrayHasKey('_required', $errors['last_name']);
    }

    /**
     * Test to check the Last name field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultLastNameNotEmpty(): void
    {
        $data = $this->_data();
        $data['last_name'] = null;
        $data['email'] = 'testuser2@domain.com';
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('last_name', $errors);
        $this->assertArrayHasKey('_empty', $errors['last_name']);
    }

    /**
     * Test to check the email field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultEmailRequiredPresence(): void
    {
        $data = $this->_data();
        unset($data['email']);
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('_required', $errors['email']);

    }

    /**
     * Test to check the email field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultEmailNotEmpty(): void
    {
        $data = $this->_data();
        $data['email'] = null;
        $validator = $this->Users->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('_empty', $errors['email']);
    }

    /**
     * Test to check the email field's unique rule validation
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefaultEmailUnique(): void
    {
        $data = $this->_data();
        unset($data['id']);
        $data['email'] = 'testuser@domain.com';
        $entity = $this->Users->newEntity($data);
        $this->assertFalse($this->Users->save($entity));
        $errors= $entity->getErrors();
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('unique', $errors['email']);
    }


    /**
     *  Test to check the role_id field's existIn rule
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::buildRules()
     */
    public function testBuildRulesRoleIdExistIn(): void
    {
        $data = $this->Users->get(UsersFixture::ID)->toArray();
//        print_r($data);
        $entity = $this->Users->newEntity($data);
        $entity->role_id = 'b43a752d-11a4-4cdd-845a-70433cca6ec6';
        $entity->password = 'test';
        $entity->email = 'testuser2@domain.com';
        $this->assertFalse($this->Users->save($entity));
        $errors= $entity->getErrors();
//        print_r($errors);
        $this->assertArrayHasKey('role_id', $errors);
        $this->assertArrayHasKey('_existsIn', $errors['role_id']);
    }
    /**
     *  Test to check the email field's isUnique rule
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::buildRules()
     */
    public function testBuildRulesEmailIsUnique(): void
    {
        $data = $this->_data();
        unset($data['id']);
        $data['email'] = 'testuser@domain.com';
        $entity = $this->Users->newEntity($data);
        $this->assertFalse($this->Users->save($entity));
        $errors= $entity->getErrors();
//        print_r($errors);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('unique', $errors['email']);
    }
}

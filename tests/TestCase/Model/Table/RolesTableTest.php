<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolesTable;
use App\Test\Fixture\RolesFixture;
use Cake\ORM\Association\HasMany;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RolesTable Test Case
 * @property RolesTable $Roles
 */
class RolesTableTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Roles',
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
        $config = $this->getTableLocator()->exists('Roles') ? [] : ['className' => RolesTable::class];
        $this->Roles = $this->getTableLocator()->get('Roles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Roles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     * @uses \App\Model\Table\RolesTable::initialize()
     */
    public function testInitialize(): void
    {
        $this->assertSame('roles', $this->Roles->getTable());
        $this->assertSame('title', $this->Roles->getDisplayField());
        $this->assertSame('id', $this->Roles->getPrimaryKey());
        $this->assertTrue($this->Roles->hasBehavior('Timestamp'));
        $this->assertTrue($this->Roles->hasAssociation('Users'));
        $this->assertInstanceOf(HasMany::class, $this->Roles->getAssociation('Users'));

    }

    /**
     * Test to check the title field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\RolesTable::validationDefault()
     */
    public function testValidationDefaultTitleRequirePresence(): void
    {
        $data = $this->Roles->get(RolesFixture::ID)->toArray();
        unset($data['title']);
        $entity = $this->Roles->newEmptyEntity();
        $role = $this->Roles->patchEntity($entity, $data)->toArray();
        $validator = $this->Roles->getValidator('default');
        $errors = $validator->validate($role);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('title', $errors);
        $this->assertArrayHasKey('_required', $errors['title']);
    }

    /**
     * Test to check the title field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\RolesTable::validationDefault()
     */
    public function testValidationDefaultTitleNotEmpty(): void
    {
        $data = $this->Roles->get(RolesFixture::ID)->toArray();
        $data['title'] = null;
        $validator = $this->Roles->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('title', $errors);
        $this->assertArrayHasKey('_empty', $errors['title']);
    }

    /**
     * Test to check the description field's maxLength validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionMaxLength(): void
    {
        $data = $this->Roles->get(RolesFixture::ID)->toArray();
        $data['description'] = 'tooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLong';
        $validator = $this->Roles->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('maxLength', $errors['description']);
    }

    /**
     * Test to check the description field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\RolesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionRequirePresence(): void
    {
        $data = $this->Roles->get(RolesFixture::ID)->toArray();
        unset($data['description']);
        $entity = $this->Roles->newEmptyEntity();
        $role = $this->Roles->patchEntity($entity, $data)->toArray();
        $validator = $this->Roles->getValidator('default');
        $errors = $validator->validate($role);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('_required', $errors['description']);
    }

    /**
     * Test to check the description field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\RolesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionNotEmpty(): void
    {
        $data = $this->Roles->get(RolesFixture::ID)->toArray();
        $data['description'] = null;
        $validator = $this->Roles->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('_empty', $errors['description']);
    }
}

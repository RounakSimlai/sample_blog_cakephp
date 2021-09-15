<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesTable;
use App\Test\Fixture\CategoriesFixture;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;

/**
 * App\Model\Table\CategoriesTable Test Case
 * @property CategoriesTable $Categories
 */
class CategoriesTableTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Categories',
        'app.Articles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Categories') ? [] : ['className' => CategoriesTable::class];
        $this->Categories = $this->getTableLocator()->get('Categories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Categories);

        parent::tearDown();
    }

    /**
     * Test Initialize method
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::initialize()
     */
    public function testInitialize(): void
    {
        $this->assertSame('categories', $this->Categories->getTable());
        $this->assertSame('name', $this->Categories->getDisplayField());
        $this->assertSame('id', $this->Categories->getPrimaryKey());
        $this->assertTrue($this->Categories->hasBehavior('Timestamp'));
        $this->assertTrue($this->Categories->hasAssociation('Articles'));
        $this->assertInstanceOf(BelongsTo::class, $this->Categories->getAssociation('ParentCategories'));
        $this->assertInstanceOf(HasMany::class, $this->Categories->getAssociation('Articles'));
        $this->assertInstanceOf(HasMany::class, $this->Categories->getAssociation('ChildCategories'));
    }

    /**
     * Test to check the name field's maxLength validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultNameMaxLength(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        $data['name'] = 'tooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLong';
        $validator = $this->Categories->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('maxLength', $errors['name']);
    }

    /**
     * Test to check the name field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultNameRequirePresence(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        unset($data['name']);
        $validator = $this->Categories->getValidator('default');
        $entity = $this->Categories->newEmptyEntity();
        $Category = $this->Categories->patchEntity($entity, $data)->toArray();
        $errors = $validator->validate($Category);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('_required', $errors['name']);
    }

    /**
     * Test to check the name field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultNameNotEmpty(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        $data['name'] = null;
        $validator = $this->Categories->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('_empty', $errors['name']);
    }

    /**
     * Test to check the description field's maxLength validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionMaxLength(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        $data['description'] = 'tooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLong';
        $validator = $this->Categories->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('maxLength', $errors['description']);

    }

    /**
     * Test to check the description field's requirePresence validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionRequirePresence(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        unset($data['description']);
        $validator = $this->Categories->getValidator('default');
        $entity = $this->Categories->newEmptyEntity();
        $Category = $this->Categories->patchEntity($entity, $data)->toArray();
        $errors = $validator->validate($Category);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('_required', $errors['description']);
    }

    /**
     * Test to check the description field's notEmpty validation
     *
     * @return void
     * @uses \App\Model\Table\CategoriesTable::validationDefault()
     */
    public function testValidationDefaultDescriptionNotEmpty(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
        $data['description'] = null;
        $validator = $this->Categories->getValidator('default');
        $errors = $validator->validate($data);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('description', $errors);
        $this->assertArrayHasKey('_empty', $errors['description']);
    }

    /**
     * Test to check the parent_id field's existIn rule
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::buildRules()
     */
    public function testBuildRulesParentIdExistIn(): void
    {
        $data = $this->Categories->get(CategoriesFixture::ID)->toArray();
//        print_r($data);
        $entity = $this->Categories->newEntity($data);
        $entity->parent_id = 'cae0ea7f-fa94-4800-b0db-b9a350c5fe33';
        $this->assertFalse($this->Categories->save($entity));
        $errors= $entity->getErrors();
//        print_r($errors);
        $this->assertArrayHasKey('parent_id', $errors);
        $this->assertArrayHasKey('_existsIn', $errors['parent_id']);
    }
}

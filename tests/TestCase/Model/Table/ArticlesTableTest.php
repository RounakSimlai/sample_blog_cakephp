<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Controller\ArticlesController;
use App\Controller\ErrorController;
use App\Model\Table\ArticlesTable;
use App\Test\Fixture\CategoriesFixture;
use App\Test\Fixture\ArticlesFixture;
use Cake\ORM\Association\BelongsTo;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * App\Model\Table\ArticlesTable Test Case
 * @property ArticlesTable $Articles
 */
class ArticlesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticlesTable
     */

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Articles',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Articles') ? [] : ['className' => ArticlesTable::class];
        $this->Articles = $this->getTableLocator()->get('Articles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */

    public function tearDown(): void
    {
        unset($this->Articles);
        parent::tearDown();
    }

    /**
     *Test to determine if the Initialize method is working.
     */

    public function testInitialize()
    {
        $this->assertEquals('articles', $this->Articles->getTable());
        $this->assertEquals('title', $this->Articles->getDisplayField());
        $this->assertEquals('id', $this->Articles->getPrimaryKey());
        $this->assertTrue($this->Articles->hasBehavior('Timestamp'));
        $this->assertTrue($this->Articles->hasAssociation('Categories'));
        $this->assertInstanceOf(BelongsTo::class, $this->Articles->getAssociation('Categories'));
        $this->assertTrue($this->Articles->hasAssociation('Users'));
        $this->assertInstanceOf(BelongsTo::class, $this->Articles->getAssociation('Users'));
    }

    /**
     * Test to check title field's maxLength validation
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefaultTitleNotMaxLength(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        $subject['title'] = 'tooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLongtooLong';
        $validator = $this->Articles->getValidator('default');
        $error = $validator->validate($subject);
//        print_r($error);
        $this->assertCount(1, $error);
        $this->assertArrayHasKey('title', $error);
        $this->assertArrayHasKey('maxLength', $error['title']);
    }

    /**
     * Test to check title field's notEmptyString validation
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefaultTitleNotEmpty(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        $subject['title'] = null;
        $validator = $this->Articles->getValidator('default');
        $error = $validator->validate($subject);
//        print_r($error);
        $this->assertCount(1, $error);
        $this->assertArrayHasKey('title', $error);
        $this->assertArrayHasKey('_empty', $error['title']);
    }

    /**
     * Test to check title field's requiredPresence validation
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefaultTitleRequiredPresence(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        unset($subject['title']);
        $validator = $this->Articles->getValidator('default');
        $entity = $this->Articles->newEmptyEntity();
        $article = $this->Articles->patchEntity($entity, $subject)->toArray();
        $error = $validator->validate($article);
//        print_r($error);
        $this->assertArrayHasKey('title', $error);
        $this->assertArrayHasKey('_required', $error['title']);
    }

    /**
     * Test to check body field's notEmptyString validation
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefaultBodyNotEmpty(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        $subject['body'] = null;
        $validator = $this->Articles->getValidator('default');
        $error = $validator->validate($subject);
//        print_r($error);
        $this->assertCount(1, $error);
        $this->assertArrayHasKey('body', $error);
        $this->assertArrayHasKey('_empty', $error['body']);
    }

    /**
     * Test to check body field's requiredPresence validation
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::validationDefault()
     */
    public function testValidationDefaultBodyRequiredPresence(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        $subject['body'] = null;
        $validator = $this->Articles->getValidator('default');
        $entity = $this->Articles->newEmptyEntity();
        $article = $this->Articles->patchEntity($entity, $subject)->toArray();
        $error = $validator->validate($article);
//        print_r($error);
        $this->assertArrayHasKey('body', $error);
        $this->assertArrayHasKey('_required', $error['body']);
    }

    /**
     * Test to check the category_id field's existIn rule
     *
     * @return void
     * @uses \App\Model\Table\ArticlesTable::buildRules()
     */
    public function testBuildRulesCategoryIdExistIn(): void
    {
        $subject = $this->Articles->get(ArticlesFixture::ID)->toArray();
        $subject['category_id'] = 'cae0ea7f-fa94-4800-b0db-b9a350c5fe39';
        $entity = $this->Articles->newEntity($subject);
        $this->assertFalse($this->Articles->save($entity));
        $errors= $entity->getErrors();
//        print_r($errors);
        $this->assertArrayHasKey('category_id', $errors);
        $this->assertArrayHasKey('_existsIn', $errors['category_id']);
    }
}

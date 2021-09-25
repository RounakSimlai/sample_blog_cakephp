<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\ArticlesTable;
use App\Model\Table\CategoriesTable;
use App\Model\Table\UsersTable;
use Cake\Collection\Collection;
use Cake\Core\App;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * @property ArticlesTable $Articles
 * @property CategoriesTable $Categories
 * @property UsersTable $User
 * @property Response $response
 */
class ArticlesController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $config = TableRegistry::getTableLocator()->get('Articles');
        $this->Articles = $config;
        if (!isset($_COOKIE['CookieAuth']) && !isset($_COOKIE['CustomCookie'])) {
            $error = [['Session Expired. Please Log in Again!']];
            $this->Flash->error(json_encode($error));
            $this->redirect('/users/logout');
        }
    }

    public function index()
    {
        $articles = $this->paginate($this->Articles);
        $user = $this->request->getAttribute('identity')->getIdentifier();
        $this->set(compact('articles','user'));
    }

    public function view($id)
    {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

    public function add()
    {
        $categories = $this->Articles->Categories->find('list')->all();
        $categories = $categories->append([count($categories) + 1 => 'Other']);
        $this->set(compact('categories'));

        if ($this->request->is('post')) {
            $article = $this->Articles->newEmptyEntity();
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->category_id = $this->request->getData('category_id');
            if ($article->category_id == $categories->countKeys()) {
                $data = $this->request->getData('newCategory');
                $this->Categories = new CategoriesTable();
                $category = $this->Categories->newEntity([
                    'name' => $data,
                    'description' => 'Category Description',
                ]);
                $category->id = $article->category_id;
                $this->Categories->save($category);
            }
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article)) {
                $this->Flash->success('Article Saved Successfully!');
                return $this->redirect(['action' => 'index'])->withStatus(200);
            }
            $this->Flash->error('Something went wrong. Please try again later!');
            $this->response = $this->response->withStatus(400);
            return $this->response;
        }
    }

    public function edit($id)
    {
        $article = $this->Articles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->id = $id;
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();
//            dd($article);
            if ($this->Articles->save($article)) {
                $this->Flash->success("Article has been updated successfully!");
                return $this->redirect(['action' => 'index'])->withStatus(200);;
            }
            $this->Flash->error('Something went wrong. Please try again later!');
            $this->response = $this->response->withStatus(400);

            return $this->response;
        }
        $this->set(compact('article'));
        $categories = $this->Articles->Categories->find('list')->all();
        $this->set(compact('categories'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success('The article has been deleted!');

            return $this->redirect(['action' => 'index'])->withStatus(200);;
        }
        $this->Flash->error('Something went wrong. Please try again later!');
        $this->response = $this->response->withStatus(404);

        return $this->response;
    }
    public function csv()
    {
        $this->response = $this->response->withDownload('ArticlesData.csv');
        $articles = $this->Articles->find('all');
        $_serialize = 'articles';
        $_header = ['ID', 'Title', 'Body', 'Category Id', 'User Id'];
        $_extract = ['id', 'title', 'body', 'category_id', 'user_id'];

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('articles', '_serialize','_header','_extract'));
    }
}

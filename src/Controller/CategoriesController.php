<?php

declare(strict_types=1);

namespace App\Controller;

use \App\Model\Table\CategoriesTable;
use App\Model\Table\UsersTable;
use Authorization\Exception\ForbiddenException;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * Categories Controller
 *
 * @property CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * @param EventInterface $event
     * @param array|string $url
     * @param Response $response
     * @return Response|void|null
     */
    public function beforeRedirect(EventInterface $event, $url, Response $response)
    {
        parent::beforeRedirect($event, $url, $response);

        $user = $this->request->getAttribute('identity');
        if ($user->role_id != '1') {
            return $this->response->withStatus(403);
        }
    }

    public function beforeFilter(EventInterface $event)
    {
        $config = TableRegistry::getTableLocator()->get('Categories');
        $this->Categories = $config;
        parent::beforeFilter($event);

        if (!isset($_COOKIE['CookieAuth']) && !isset($_COOKIE['CustomCookie'])) {
            $error = [['Session Expired. Please Log in Again!']];
            $this->Flash->error(json_encode($error));
            $this->redirect('/users/logout');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->paginate = [
            'contain' => ['ParentCategories'],
        ];
        $categories = $this->paginate($this->Categories);
        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Articles', 'ChildCategories'],
        ]);

        $this->set(compact('category'));
    }


    public function add()
    {
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success('Category Saved Successfully!');
                return $this->redirect(['action' => 'index'])->withStatus(200);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be updated. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function csv()
    {
        $this->response = $this->response->withDownload('CategoriesData.csv');
        $categories = $this->Categories->find('all');
        $_serialize = 'categories';
        $_header = ['ID', 'Parent Id', 'Name', 'Description'];
        $_extract = ['id', 'parent_id', 'name', 'description'];

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('categories', '_serialize', '_header', '_extract'));
    }
}

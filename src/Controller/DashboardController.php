<?php

namespace App\Controller;

use App\Model\Table\ArticlesTable;
use App\Model\Table\CategoriesTable;
use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * @property ArticlesTable $Articles
 * @property CategoriesTable $Categories
 * @property UsersTable $Users
 * @property Response $response
 */
class DashboardController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $config = TableRegistry::getTableLocator()->get('Articles');
        $this->Articles = $config;

        $config = TableRegistry::getTableLocator()->get('Categories');
        $this->Categories = $config;

        $config = TableRegistry::getTableLocator()->get('Users');
        $this->Users = $config;

        parent::beforeFilter($event);
    }
    public function index()
    {
        $users = $this->Users->find('all')->toArray();
        $articles = $this->Articles->find('all')->toArray();
        $categories =  $this->Categories->find('all')->toArray();

        $this->set(compact('users','articles','categories'));
    }
}

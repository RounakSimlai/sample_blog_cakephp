<?php

declare(strict_types=1);

namespace App\Controller;

use \App\Model\Table\CategoriesTable;
use App\Model\Table\UsersTable;
use Authorization\Exception\ForbiddenException;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use CodeItNow\BarcodeBundle\Utils\QrCode;

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
        parent::beforeFilter($event);

        if (!isset($_COOKIE['CookieAuth']) && !isset($_COOKIE['CustomCookie'])) {
            $error = [['Session Expired. Please Log in Again!']];
            $this->Flash->error(json_encode($error));
            $this->redirect('/users/logout');
        }

        $config = TableRegistry::getTableLocator()->get('Categories');
        $this->Categories = $config;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if ($this->getRequest()->getQuery('search')) {
            $query = $this->Categories->find()->where(function (QueryExpression $expression) {
                $conditions = [
                    $this->Categories->aliasField('name') . ' LIKE' => '%' . $this->getRequest()->getQuery('search'),
                    $this->Categories->aliasField('description') . ' LIKE' => '%' . $this->getRequest()->getQuery('search'),
                ];
                return $expression->or($conditions);
            });
            $categories = $this->paginate($query);
        } else {
            $this->paginate = [
                'contain' => ['ParentCategories'],
            ];
            $categories = $this->paginate($this->Categories);
        }
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
        $qrCode = new QrCode();
        $qrCode
            ->setText(" Id: $category->id \n parent_id: $category->parent_id \n Name: $category->name \n Description: $category->description \n Created: $category->created \n Modified: $category->modified")
            ->setSize(200)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $qr = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        $this->set(compact('category','qr'));
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

    /**
     * @param $id
     * @return Response|void|null
     */
    public function disable($id)
    {
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($category->disabled !== null) {
                $category->disabled = null;
                if ($this->Categories->save($category)) {
                    $this->Flash->success("Category has been enabled successfully!");
                    return $this->redirect(['action' => 'index'])->withStatus(200);
                }
            }
            if ($category->disabled === null) {
                $category->disabled = new FrozenTime();
                if ($this->Categories->save($category)) {
                    $this->Flash->success("Category has been disabled successfully!");
                    return $this->redirect(['action' => 'index'])->withStatus(200);
                }
            }
            $this->Flash->error('Something went wrong. Please try again later!');
            $this->response = $this->response->withStatus(400);

            return $this->response;
        }
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

    public function pdf()
    {
        $this->viewBuilder()->enableAutoLayout(false);
        $categories = $this->Categories->find('all');
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true,
                'filename' => 'CategoriesData.pdf'
            ]
        );
        $this->set('categories', $categories);
    }

    public function search()
    {
        //Download all records at once
        $this->paginate['maxLimit'] = 999;

        $categories = $this->paginate($this->Categories->find('search', ['search' => $this->request->getQuery()]));

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }
}

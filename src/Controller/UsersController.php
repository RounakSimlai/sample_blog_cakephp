<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\RolesTable;
use App\Model\Table\UsersTable;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * @property UsersTable $Users
 * @property RolesTable $Roles
 * @property Response $response
 */
class UsersController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $config = TableRegistry::getTableLocator()->get('Users');
        $this->Users = $config;
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
//        dd($result->isValid());
        if ($result->isValid()) {
            $this->Flash->success('Logged in Successfully!');
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Dashboard',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid Credentials');
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login',
            ]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $User = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('User'));
    }

    public function add()
    {
        $this->getRequest()->allowMethod(['post', 'get']);
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $postData = $this->getRequest()->getData();
            $user = $this->Users->patchEntity($user, $postData);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account Created. Please Login to Continue!'));
                return $this->redirect([
                    'action' => 'login',
                ]);
            } else {
                $this->Flash->error('Something went wrong. Please try again later!');
                $this->response->withStatus(400);
            }
        }
        $this->set(compact('user'));
        $roles = $this->Users->Roles->find('list')->all();
        $this->set(compact('roles'));
    }


    /**
     * @param $id
     * @return Response|void|null
     */
    public function edit($id)
    {
        $this->getRequest()->allowMethod(['post', 'get', 'patch', 'put']);
        $User = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($User, $this->request->getData());
//            dd($user);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account Details updated!'));
                return $this->redirect([
                    'controller' => 'Dashboard',
                    'action' => 'index',
                ]);
            } else {
                $this->Flash->error(__('Something went wrong. Please try again later!'));
                $this->response = $this->response->withStatus(400);

                return $this->response;
            }
        }
        $this->set(compact('User'));
    }


    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
            return $this->redirect([
                'action' => 'index',
            ]);
        }
        $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        $this->response = $this->response->withStatus(404);

        return $this->response;
    }

    /**
     * @param $id
     * @return Response|void|null
     */
    public function password($id)
    {
        $this->getRequest()->allowMethod(['post', 'get', 'patch', 'put']);
        $User = $this->Users->get($id);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
//            $currentPass = $this->getRequest()->getData('currentPass');
//            $newPass = $this->getRequest()->getData('newPass');
//            $confirmPass = $this->getRequest()->getData('confirmPass');
            $user = $this->Users->patchEntity($User, $this->getRequest()->getData(), [
                'validate' => 'password',
            ]);
//            dd($user->getErrors());
            $user->password = $newPass;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Password Updated Successfully! Please Login Again for security reasons!'));
                return $this->redirect([
                    'controller' => 'Users',
                    'action' => 'logout',
                ]);
            } else {
                $errors = json_encode($user->getErrors());
                $this->Flash->error($errors);

            }
        }
    }
}

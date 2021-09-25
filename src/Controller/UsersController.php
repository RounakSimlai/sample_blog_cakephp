<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application;
use App\Model\Table\RolesTable;
use App\Model\Table\UsersTable;
use Authentication\AuthenticationService;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;


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
        if ($result->isValid()) {
            if (!isset($_COOKIE['CookieAuth'])) {
                setcookie('CustomCookie', 'Not Remembered', [
                    'expires' => time() + 60,
                    'path' => '/',
                    'secure' => false,
                    'httponly' => false,
                ]);
            }
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
            setcookie('CustomCookie', 'Not Remembered', [
                'expires' => 60,
                'path' => '/',
                'secure' => false,
                'httponly' => false,
            ]);
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
            if (!$user->getErrors()) {
                $image = $this->getRequest()->getData('image_file');
                $name = $image->getClientFileName();
                $targetPath = WWW_ROOT . 'img' . DS . $name;
                if ($name) {
                    $user->image = $name;
                    $image->moveTo($targetPath);
                } else {
                    $user->image = 'noPic.png';
                }
            }
            $user->role_id = '2';
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
            $user->password = $this->getRequest()->getData('newPass');
            if ($this->Users->save($user)) {

                $mailer = new Mailer('mail');
                $mailer
                    ->setTo('www.rounak1999@gmail.com')
                    ->setSubject('Password Change')
                    ->deliver('Password Changed Successfully. If it was not you, contact administrator immediately!');

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

    /**
     * @param $id
     * @return Response|void|null
     */
    public function profilePic($id)
    {
        $this->getRequest()->allowMethod(['post', 'get', 'patch', 'put']);
        $User = $this->Users->get($id);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($User, $this->request->getData());
            $image = $this->request->getData('image_file');
//            dd($image);
            $name = $image->getClientFileName();
            $targetPath = WWW_ROOT . 'img' . DS . $name;
            $user->image = $name;
//            dd($user->image);
            $image->moveTo($targetPath);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Profile Picture Updated Successfully!'));
                return $this->redirect([
                    'controller' => 'Users',
                    'action' => 'view',
                    $User->id,
                ]);
            } else {
                $errors = json_encode($user->getErrors());
                $this->Flash->error($errors);
            }
        }
    }
}

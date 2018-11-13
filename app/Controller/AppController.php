<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeTime', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Session',
        'Cookie',
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'proas',
                'action' => 'index',
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'scope' => array('enabled' => 1),
                    'passwordHasher' => 'Blowfish',
                ),
            ),
            'authorize' => 'Controller',
        ),
        'DebugKit.Toolbar',
    );

    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        CakeNumber::addFormat('BRL', array(
            'before' => 'R$ ',
            'thousands' => '.',
            'decimals' => ',',
            'places' => 2,
            'negative' => '- ',
            'zero' => 'R$ 0,00',
        ));

        if ($this->Auth->loggedIn()) {
            $this->Auth->unauthorizedRedirect = $this->referer();
            $this->Auth->authError = __('You are not authorized to access that location.');
            $this->Auth->flash['element'] = 'error';
            // $this->set('perms', $this->{$this->modelClass}->perms);
        } else {
            $this->Auth->authError = false;
        }

        if ($this->Session->read('perms') == null) {
            $this->Session->write('perms', $this->{$this->modelClass}->perms);
        }

        if ($this->isAuthorized()) {
            $this->Auth->allow($this->params['action']);
        }
    }

    public function isAuthorized($user = null) {
        $authorized = false;
        if (isset($this->{$this->modelClass}->perms[$this->params['controller']][$this->params['action']]) && is_array($this->{$this->modelClass}->perms[$this->params['controller']][$this->params['action']])) {
            $authorized = in_array('semAutenticacao', $this->{$this->modelClass}->perms[$this->params['controller']][$this->params['action']]);
            if (!$authorized && isset($user['role']) && !empty($user['role'])) {
                $authorized = in_array($user['role'], $this->{$this->modelClass}->perms[$this->params['controller']][$this->params['action']]);
            }
        }
        return $authorized;
    }

    public function beforeRender() {
        $controller = __(Inflector::humanize(Inflector::underscore($this->params['controller'])));
        $action = ($this->params['action'] !== 'index')?' | '.__(Inflector::humanize(Inflector::underscore($this->params['action']))):'';
        $this->set('title_for_layout', $controller.$action);
    }

    private function translateText() {
        $text = __('Cash Advance');
        $text = __('Default');
        $text = __('Administrator');
        $text = __('Confirm Password');
        $text = __('Current Password');
        $text = __('Token Expiration Time');
        $text = __('Administrator Email');
        $text = __('App Name');
        $text = __('Email Send Mail');
        $text = __('Email Host');
        $text = __('Email Port');
        $text = __('Email Tls');
        $text = __('Email Ssl');
        $text = __('Email Timeout');
        $text = __('Email Username');
        $text = __('Email Password');
        $text = __('Email From Name');
        $text = __('Email From Email');
        $text = __('Email Reply To');
        $text = __('Email Cc');
        $text = __('Email Bcc');
        $text = __('Yes');
        $text = __('No');
    }

}

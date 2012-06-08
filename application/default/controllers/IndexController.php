<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author robert
 */
class IndexController extends Zend_Controller_Action
{

    function init()
    {
        if(!Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_redirect('login/index');
        }
    }

    public function indexAction()
    {
        $userInfo = Zend_Auth::getInstance()->getStorage()->read();

        $this->view->username = $userInfo->username;
        $this->view->name = $userInfo->name;
        $this->view->email = $userInfo->email;
    }

    public function anotherAction()
    {
    }
}
?>

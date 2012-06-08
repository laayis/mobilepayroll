<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors',1); // set this to 0 on live version

date_default_timezone_set("Europe/Belgrade");

set_include_path('.' . PATH_SEPARATOR . '../library' .
						PATH_SEPARATOR . '../application/default/models' .
						PATH_SEPARATOR . get_include_path());

include("Zend/Loader.php");

Zend_Loader::registerAutoload(); // It auto loads a class when it is called

Zend_Session::start();

$config = new Zend_Config_Ini('../application/default/config/db_config.ini', 'offline');
$registry = Zend_Registry::getInstance();
$registry->set('db_config',$config);
$db_config = Zend_Registry::get('db_config');
$db = Zend_Db::factory($db_config->db);
Zend_Db_Table::setDefaultAdapter($db);

Zend_Layout::startMVC();

/**
* Zend_Controller_Front's purpose is to initialize the request environment, route the incoming request, and then dispatch any discovered actions;
* it aggregates any responses and returns them when the process is complete.
 */
$frontcontroller = Zend_Controller_Front::getInstance();
$frontcontroller->throwExceptions(true);
$frontcontroller->setControllerDirectory(array(
					'default'=>'../application/default/controllers',
					));

$route = new Zend_Controller_Router_Route(
            'logout',
            array('controller'=>'login',
                'action'=>'logout'
            )
            );

$router = $frontcontroller->getRouter();
$router->addRoute('logout', $route);
$frontcontroller->dispatch(); // GO!!!

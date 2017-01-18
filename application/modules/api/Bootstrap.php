<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  protected function _initDoctype()
  {
    $this->bootstrap('view');
    $view = $this->getResource('view');
    $view->doctype('XHTML1_STRICT');
  }

  public function _initRoutes()
  {
    $front = Zend_Controller_Front::getInstance();
    $router = $front->getRouter();

    // Specifying all controllers as RESTful:
    $restRoute = new Zend_Rest_Route($front);
    $router->addRoute('default', $restRoute);

    // Specifying the "api" module as RESTful, and the "task" controller of the
    // "backlog" module as RESTful:
    $restRoute = new Zend_Rest_Route($front, array(), array(
        'api',
        'backlog' => array('task'),
    ));
    $router->addRoute('rest', $restRoute);
  }

}

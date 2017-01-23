<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
  protected function _initRoutes()
  {
      $Db = new Application_Model_Init();
      $Db->initDb();
      include APPLICATION_PATH . "/configs/routes.php";
  }
}

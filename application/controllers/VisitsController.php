<?php

class VisitsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $visits = new Application_Model_VisitsMapper();
      $this->view->entries = $visits->fetchAll();
    }

    public function signAction()
    {
        // action body
    }


}



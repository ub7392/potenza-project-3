<?php

class PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $people = new Application_Model_PeopleMapper();
      $this->view->entries = $people->fetchAll();
    }

    public function signAction()
    {
        // action body
    }


}



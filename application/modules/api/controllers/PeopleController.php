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

      //$this->view->entries = Zend_Json::encode($entries);
    }

    // Handle GET and return a specific resource item
    public function getAction()
    {

    }

    // Handle POST requests to create a new resource item
    public function postAction()
    {

    }

}

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

    // Handle GET and return a specific resource item
    public function getAction()
    {
      //api/visits

      //api/visits/:id

    }

    // Handle POST requests to create a new resource item
    public function postAction()
    {
      //api/visits
    }
}

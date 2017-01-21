<?php

class StatesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $states = new Application_Model_StatesMapper();
      $this->view->entries = $states->fetchAll();

      //report error first if there is no id
      $matches = $this->getEvent()->getRouteMatch();
      $id      = $matches->getParam('id', false);
      if (!$id) {
          $response = $this->getResponse();
          $response->setStatusCode(404);
          $this->getEvent()->setResult('Invalid identifier; cannot complete request');
          return;
      }else{
        getAction();
      }
    }

    // Handle GET and return a specific resource item
    public function getAction()
    {
      //api/states

    }
}

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

      //report error first if there is no id
      $matches = $this->getEvent()->getRouteMatch();
      $id      = $matches->getParam('id', false);
      if (!$id) {
          $response = $this->getResponse();
          $response->setStatusCode(404);
          $this->getEvent()->setResult('Invalid identifier; cannot complete request');
          return;
      }else{
        if ($this->getRequest()->isGET())
        {
          getAction();
          echo "this is get request";
        }
        else
        {
          postAction();
          echo "this is post request";
        }
      }
    }

    // Handle GET and return a specific resource item
    public function getAction()
    {
      if(){
      //api/visits
        $response->setStatusCode(200);

      }else{
      //api/visits/:id
        $response->setStatusCode(400);

      }
    }

    // Handle POST requests to create a new resource item
    public function postAction()
    {
      //api/visits
        $response->setStatusCode(201);

    }
}

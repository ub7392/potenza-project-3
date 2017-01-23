<?php

class StatesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $states = new Api_Model_StatesMapper();
      $this->view->entries = $states->fetchAll();
    }

    public function getAction()
    {
      $data = new Api_Model_StatesMapper();
      $this->view->entries = $data->find();

    }
}

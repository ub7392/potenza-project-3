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
    }


}

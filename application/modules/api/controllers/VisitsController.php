<?php

class VisitsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      if($this->getRequest()->isGet()){
        $visits = new Api_Model_VisitsMapper();
        $this->view->entries = $visits->fetchAll();
      }else if ($this->getRequest()->isPost()){
        $data = $this->getRequest()->isPost();
        $visitsdata = new Api_Model_Visits();
        $visitsdata ->setPersonid($data['_personid'])
                    ->setStateid($data['_statesid'])
                    ->setDatevisited($data['_datevisited']);
        $map = new Api_Model_VisitsMapper();
        $map->save($visitsdata);
      }
    }

    public function getAction()
    {
      $map = new Api_Model_VisitsMapper();
      $this->view->entries = $map->find();
    }

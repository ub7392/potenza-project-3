<?php

class API_VisitsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      if($this->getRequest()->isGet()){
        $visits = new API_Model_VisitsMapper();
        $this->view->entries = $visits->fetchAll();
      }else if ($this->getRequest()->isPost()){
        $data = $this->getRequest()->isPost();
        $visitsdata = new API_Model_Visits();
        $visitsdata ->setPersonid($data['person_id'])
                    ->setStateid($data['state_id'])
                    ->setDatevisited($data['date_visited']);
        $map = new API_Model_VisitsMapper();
        $map->save($visitsdata);
      }
    }

    public function getAction()
    {
      $map = new API_Model_VisitsMapper();
      $this->view->entries = $map->find();
    }
  }

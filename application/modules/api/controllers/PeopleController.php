<?php

class API_PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      if($this->getRequest()->isGet()){
        $people = new API_Model_PeopleMapper();
        $this->view->entries = $people->fetchAll();
      }else if($this->getRequest()->isPost()){
        $data = $this->getRequest()->isPost();
        $peopledata = new API_Model_People;
        $peopledata ->setFirstname($data['first_name'])
                    ->setLastname($data['last_name'])
                    ->setFavoritefood($data['favorite_food']);
        $map = new API_Model_PeopleMapper();
        $map->save($peopledata);
      }

    }

    public function getAction()
    {
      $map = new API_Model_PeopleMapper();
      $this->view->entries = $map->find();
    }
}

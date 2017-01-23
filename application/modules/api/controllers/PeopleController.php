<?php

class PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      if($this->getRequest()->isGet()){
        $people = new Api_Model_PeopleMapper();
        $this->view->entries = $peopleMapper->fetchAll();
      }else if($this->getRequest()->isPost())){
        $data = $this->getRequest()->isPost();
        $peopledata = new Api_Model_People;
        $peopledata ->setFirstname($data['_firstname'])
                    ->setLastname($data['_lastname'])
                    ->setFavoritefood($data['_favoritefood']);
        $map = new Api_Model_PeopleMapper();
        $map->save($peopledata);
      }
    }

    public function getAction()
    {
      $map = new Api_Model_PeopleMapper();
      $this->view->entries = $map->find();
    }
}

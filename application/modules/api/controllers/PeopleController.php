<?php

class PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      if($this->getRequest()->isGET()){
        $people = new Api_Model_PeopleMapper();
        $this->view->entries = $people->fetchAll();
      }else if ($this->getRequest()->isPOST()){
        $data = $this->getRequest()->isPOST();
        $peopledata = new Api_Model_People;
        $peopledata ->setFirstname($data['_firstname'])
                    ->setLastname($data['_lastname'])
                    ->setFavoritefood($data['_favoritefood']);
        $map = new Api_Model_PeopleMapper();
        $map->save($people);

      }
    }

    public function getAction()
    {
      $map = new Api_Model_PeopleMapper();
      $this->view->entries = $map->find();
    }
}

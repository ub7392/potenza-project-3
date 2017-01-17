<?php

class PeopleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $people = new Application_Model_PeopleMapper();
      $this->view->entries = $people->fetchAll();

      //$this->view->entries = Zend_Json::encode($entries);
    }

    public function signAction()
    {
        // action body
    }

}









/*

public function indexAction()
    {
        $method = new Zend_Controller_Request_Http();
        if($method->getMethod() == 'GET'){
            $apiData = new API_Model_FriendsDBMapper();
            $this->view->entries = $apiData->fetchAll();
        }elseif($method->getMethod() == 'POST'){
            $params = new Zend_Controller_Request_Http();
            $data = $params->getPost();
            $friend = new API_Model_FriendsDB();
            $friend    ->setFirstName($data['_fname'])
                       ->setLastName($data['_lname'])
                       ->setFavFood($data['_favfood']);
            $apiData = new API_Model_FriendsDBMapper();
            $apiData->save($friend);
        }else{

        }
    }
    public function getAction()
    {
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->getById();
    }*/

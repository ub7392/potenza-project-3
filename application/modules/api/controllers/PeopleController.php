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

        try{
          // 200 - Success
          // 400 - Bad Request
          // 500 - Server Error
          $data = $people->fetchAll();

          http_response_code(200);
          header('Content-type: application/json');
          echo json_encode($data);
          die();
        }catch(\Exception $e){
          $data = $e->getMessage();

          http_response_code(500);
          header('Content-type: application/json');
          echo json_encode($data);
          die();
        }
      }else if($this->getRequest()->isPost()){
        try{
          // 200 - Success
          // 400 - Bad Request
          // 500 - Server Error
          $data = $this->getRequest()->getPost();

          $people = new API_Model_People();
          $people ->setFirstname($data['first_name'])
                  ->setLastname($data['last_name'])
                  ->setFavoritefood($data['favorite_food']);
          $map = new API_Model_PeopleMapper();
          $map->save($people);

          header('Content-type: application/json');
          echo json_encode(http_response_code(200));
          die();
        }catch(\Exception $e){
          $data = $e->getMessage();

          http_response_code(500);
          header('Content-type: application/json');
          echo json_encode($data);
          die();
        }
      }
    }

    public function getAction()
    {
      $people = new API_Model_PeopleMapper();

      try{
        // 200 - Success
        // 400 - Bad Request
        // 500 - Server Error
        $data = $this->getRequest()->getParam('people_id');
        $find = $people->find($data);

        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode($find);
        die();
      }catch(\Exception $e){
        $data = $e->getMessage();

        http_response_code(500);
        header('Content-type: application/json');
        echo json_encode($data);
        die();
      }

    }
}

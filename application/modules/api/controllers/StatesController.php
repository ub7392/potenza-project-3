<?php

class API_StatesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $states = new API_Model_StatesMapper();

      try{
        // 200 - Success
        // 400 - Bad Request
        // 500 - Server Error
        $data = $states->fetchAll();

        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode($data);
      }catch(\Exception $e){
        $data = $e->getMessage();

        http_response_code(500);
        header('Content-type: application/json');
        echo json_encode($data);
      }
    }

    public function getAction()
    {
      $states = new API_Model_StatesMapper();

      try{
        // 200 - Success
        // 400 - Bad Request
        // 500 - Server Error
        $data = $this->getRequest()->getParam('states_id');
        $find = $states->find($data);

        http_response_code(200);
        header('Content-type: application/json');
        echo json_encode($find);
        die();
      }catch(\Exception $e){
        $data = $e->getMessage();

        http_response_code(500);
        header('Content-type: application/json');
        echo json_encode($find);
        die();
      }
    }
}

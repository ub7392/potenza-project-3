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

        try{
          // 200 - Success
          // 400 - Bad Request
          // 500 - Server Error
          $data = $visits->fetchAll();

          http_response_code(200);
          header('Content-type: application/json');
          echo json_encode($data);
        }catch(\Exception $e){
          $data = $e->getMessage();

          http_response_code(500);
          header('Content-type: application/json');
          echo json_encode($data);
        }
      }else if ($this->getRequest()->isPost()){
        try{
          // 200 - Success
          // 400 - Bad Request
          // 500 - Server Error
          $data = $this->getRequest()->getPost();

          $visits = new API_Model_Visits();
          $visits ->setPersonid($data['peoplevisit'])
                  ->setStateid($data['states'])
                  ->setDatevisited($data['date_visited']);
          $map = new API_Model_VisitsMapper();
          $map->save($visits);

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
      $visits = new API_Model_VisitsMapper();

      try{
        // 200 - Success
        // 400 - Bad Request
        // 500 - Server Error
        $data = $this->getRequest()->getParam('person_id');
        $find = $visits->find($data);

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

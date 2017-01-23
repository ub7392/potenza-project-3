<?php

class Api_Model_PeopleMapper
{
  protected $_dbTable;

  public function setDbTable($dbTable)
  {
      if (is_string($dbTable)) {
          $dbTable = new $dbTable();
      }
      if (!$dbTable instanceof Zend_Db_Table_Abstract) {
          throw new Exception('Invalid table data gateway provided');
      }
      $this->_dbTable = $dbTable;
      return $this;
  }

  public function getDbTable()
  {
      if (null === $this->_dbTable) {
          $this->setDbTable('Api_Model_DbTable_People');
      }
      return $this->_dbTable;
  }

  public function save(Api_Model_People $people)
  {
      $data = array(
          'people_id' => $people->getPeopleid(),
          'first_name'   => $people->getFirstname(),
          'last_name' => $people->getLastname(),
          'favorite_food' => $people->getFavoritefood()
      );

      if (null === ($people_id = $people->getId())) {
          unset($data['people_id']);
          $this->getDbTable()->insert($data);
      } else {
          $this->getDbTable()->update($data, array('people_id = ?' => $people_id));
      }
  }

  public function find()
  {
      $requestURI = parse_url($_SERVER['REQUEST_URI']);
      $segments = explode('/', $requestURI['path']);
      $apiVars = [];

      $i = 2;
      while($i < count($segments)){
      	if($segments[$i+1]) {
            $apiVars[$segments[$i]] = $segments[$i+1];
            $i += 2;
      	} else {
            $apiVars[$segments[$i]] = 'null';
            $i++;
      	}
      }

      $result = $this->getDbTable()->fetchAll();
      $entries = array();
      foreach ($result as $row) {
          $entry = new Api_Model_People();
          $entry->setId($row->people_id)
                ->setFirstname($row->first_name)
                ->setLastname($row->last_name)
                ->setFavoriteFood($row->favorite_food);
          $entries[] = $entry;
      }

      foreach($entries as $entryobj){
        if($apiVars['people'] == $entryobj->people_id){
          $resultArray[] = [
            'people_id'     => $entryObj->people_id,
            'first_name'    => $entryObj->first_name,
            'last_name'     => $entryObj->last_name,
            'favorite_food' => $entryObj->favorite_food
          ];
        }
      }

      echo json_encode($resultArray);
  }

  public function fetchAll()
  {
      $result = $this->getDbTable()->fetchAll();
      $entries = array();
      foreach ($result as $row) {
          $entry = new Api_Model_People();
          $entry->setId($row->people_id)
                ->setFirstname($row->first_name)
                ->setLastname($row->last_name)
                ->setFavoriteFood($row->favorite_food);
          $entries[] = $entry;
      }

      foreach($entries as $entryObj){
        $resultArray[] = [
          'people_id'     => $entryObj->people_id,
          'first_name'    => $entryObj->first_name,
          'last_name'     => $entryObj->last_name,
          'favorite_food' => $entryObj->favorite_food
        ];
      }
      echo json_encode($resultArray);
  }
}

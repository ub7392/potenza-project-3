<?php

class Api_Model_VisitsMapper
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
          $this->setDbTable('Api_Model_DbTable_Visits');
      }
      return $this->_dbTable;
  }

  public function save(Api_Model_DbTable_Visits $visits)
  {
      $data = array(
          'id' => $visits->getId(),
          'person_id'   => $visits->getPersonid(),
          'state_id' => $visits->getStateid(),
          'date_visited' => $visits->getDatevisited()
      );

      if (null === ($id = $visits->getId())) {
          unset($data['id']);
          $this->getDbTable()->insert($data);
      } else {
          $this->getDbTable()->update($data, array('id = ?' => $id));
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
          $entry = new Api_Model_Visits();
          $entry->setId($row->id)
                ->setPersonid($row->person_id)
                ->setStateid($row->state_id)
                ->setDatevisited($row->date_visited);
          $entries[] = $entry;
      }

      foreach($entries as $entryobj){
        if($apiVars['people'] == $entryobj->peopleid){
          $resultArray[] = [
            'id'          => $entryObj->id,
            'person_id'    => $entryObj->person_id,
            'state_id'     => $entryObj->state_id,
            'date_visited' => $entryObj->date_visited
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
        $entry = new Api_Model_Visits();
        $entry->setId($row->id)
              ->setPersonid($row->person_id)
              ->setStateid($row->state_id)
              ->setDatevisited($row->date_visited);
        $entries[] = $entry;
    }

    foreach($entries as $entryobj){
      $resultArray[] = [
        'id'          => $entryObj->id,
        'person_id'    => $entryObj->person_id,
        'state_id'     => $entryObj->state_id,
        'date_visited' => $entryObj->date_visited
      ];
    }

    echo json_encode($resultArray);
  }

}

<?php

class API_Model_StatesMapper
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
          $this->setDbTable('API_Model_DbTable_States');
      }
      return $this->_dbTable;
  }

  public function save(API_Model_DbTable_States $states)
  {
      $data = array(
          'states_id' => $states->getStatesid(),
          'states_name'   => $states->getStatesname(),
          'states_abbreviation' => $states->getStatesabbreviation()
      );

      if (null === ($states_id = $states->getId())) {
          unset($data['states_id']);
          $this->getDbTable()->insert($data);
      } else {
          $this->getDbTable()->update($data, array('states_id = ?' => $states_id));
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
      foreach($result as $row){
        $entry = new API_Model_States();
        $entry->setStatesid($row->states_id)
              ->setStatesname($row->states_name)
              ->setStatesabbreviation($row->states_abbreviation);
        $entries[] = $entry;
      }

      foreach($entries as $entryObj){
        if($apiVars['states'] == $entryObj->states_id){
          $resultArray[] = [
            'states_id'           => $entryObj->states_id,
            'states_name'         => $entryObj->states_name,
            'states_abbreviation' => $entryObj->states_abbreviation
          ];
        }
      }
    echo json_encode($resultArray);
  }

  public function fetchAll()
  {
      $resultSet = $this->getDbTable()->fetchAll();
      $entries = array();
      foreach($resultSet as $row)
      {
        $entry = new API_Model_States();
        $entry->setStatesid($row->states_id)
              ->setStatesname($row->states_name)
              ->setStatesabbreviation($row->states_abbreviation);
        $entries[] = $entry;
      }
      foreach($entries as $entryObj)
      {
        $resultArray[] =
        [
          'states_id'           => $entryObj->states_id,
          'states_name'         => $entryObj->states_name,
          'states_abbreviation' => $entryObj->states_abbreviation,
        ];
      }
      echo json_encode($resultArray);
  }

}

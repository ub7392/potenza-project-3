<?php

class Api_Model_StatesMapper
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
          $this->setDbTable('Api_Model_DbTable_States');
      }
      return $this->_dbTable;
  }

  public function save(Api_Model_DbTable_States $states)
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
        $entry = new Api_Model_States();
        $entry->setId($row->states_id)
              ->set($row->states_name)
              ->set($row->states_abbreviation);
        $entries[] = $entry;
      }

      foreach($entries as $entryobj){
        if($apiVars['states'] == $entryobj->id){
          $resultArray[] = [
            'states_id'           => $entryobj->states_id,
            'states_name'         => $entryobj->states_name,
            'states_abbreviation' => $entryobj->state_abbreviation
          ];
        }
      }

    echo json_encode($resultArray);
  }

  public function fetchAll()
  {
      $resultSet = $this->getDbTable()->fetchAll();
      $entries = array();
      foreach ($resultSet as $row) {
          $entry = new Api_Model_States();
          $entry->setId($row->states_id)
                ->setStatename($row->states_name)
                ->setStateabbreviation($row->states_abbreviation)
          $entries[] = $entry;
      }

      foreach($entries as $entryobj){
        $resultArray[] = [
          'states_id'           => $entryobj->states_id,
          'states_name'         => $entryobj->states_name,
          'states_abbreviation' => $entryobj->states_abbreviation
        ];
      }

      echo json_encode($resultArray);
  }

}

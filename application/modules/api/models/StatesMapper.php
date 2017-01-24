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

  public function find($data)
  {
      $result = $this->getDbTable()->find($data);

      if (0 == count($result)){
        return;
      }
      $states = new API_Model_States();

      $row = $result->current();
      $states->setStatesid($row->states_id)
             ->setStatesname($row->states_name)
             ->setStatesabbreviation($row->states_abbreviation);

      $resultArray[] =
      [
          'states_id'           => $states->Statesid,
          'states_name'         => $states->Statesname,
          'states_abbreviation' => $states->Statesabbreviation
      ];

      return $resultArray;
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
          'states_id'           => $entryObj->Statesid,
          'states_name'         => $entryObj->Statesname,
          'states_abbreviation' => $entryObj->Statesabbreviation,
        ];
      }
      return $resultArray;
  }

}

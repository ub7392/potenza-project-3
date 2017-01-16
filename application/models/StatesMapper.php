<?php

class Application_Model_StatesMapper
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
          $this->setDbTable('Application_Model_DbTable_States');
      }
      return $this->_dbTable;
  }

  public function save(Application_Model_DbTable_States $states)
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

  public function find($id, Application_Model_DbTable_States $states)
  {
      $result = $this->getDbTable()->find($states_id);
      if (0 == count($result)) {
          return;
      }
      $row = $result->current();
      $states->setId($row->states_id)
                ->set($row->states_name)
                ->set($row->states_abbreviation)
  }

  public function fetchAll()
  {
      $resultSet = $this->getDbTable()->fetchAll();
      $entries   = array();
      foreach ($resultSet as $row) {
          $entry = new Application_Model_DbTable_States();
          $entry->setId($row->states_id)
                ->setFirstname($row->states_name)
                ->setLastname($row->states_abbreviation)
          $entries[] = $entry;
      }
      return $entries;
  }

}

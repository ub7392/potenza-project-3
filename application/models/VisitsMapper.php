<?php

class Application_Model_VisitsMapper
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
          $this->setDbTable('Application_Model_DbTable_Visits');
      }
      return $this->_dbTable;
  }

  public function save(Application_Model_DbTable_Visits $visits)
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

  public function find($id, Application_Model_DbTable_Visits $visits)
  {
      $result = $this->getDbTable()->find($id);
      if (0 == count($result)) {
          return;
      }
      $row = $result->current();
      $visits->setId($row->id)
                ->setPersonid($row->person_id)
                ->setStateid($row->state_id)
                ->setDatevisited($row->date_visited);
  }

  public function fetchAll()
  {
      $resultSet = $this->getDbTable()->fetchAll();
      $entries   = array();
      foreach ($resultSet as $row) {
          $entry = new Application_Model_DbTable_Visits();
          $entry->setId($row->id)
                ->setPersonid($row->person_id)
                ->setStateid($row->state_id)
                ->setDatevisited($row->date_visited);
          $entries[] = $entry;
      }
      return $entries;
  }

}

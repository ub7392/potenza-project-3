<?php

class API_Model_VisitsMapper
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
          $this->setDbTable('API_Model_DbTable_Visits');
      }
      return $this->_dbTable;
  }

  public function save(API_Model_DbTable_Visits $visits)
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

  public function find($data)
  {
      $result = $this->getDbTable()->find($data);
      if (0 == count($result)){
        return;
      }

      $visits = new API_Model_Visits();
      $row = $result->current();
      $visits->setId($row->id)
             ->setPersonid($row->person_id)
             ->setStateid($row->state_id)
             ->setDatevisited($row->date_visited);

      $resultArray[] = [
        'id'          => $visits->id,
        'person_id'    => $visits->Personid,
        'state_id'     => $visits->Stateid,
        'date_visited' => $visits->Datevisited
      ];

      return $resultArray;
  }

  public function fetchAll()
  {
    $result = $this->getDbTable()->fetchAll();
    $entries = array();
    foreach ($result as $row) {
        $entry = new API_Model_Visits();
        $entry->setId($row->id)
              ->setPersonid($row->person_id)
              ->setStateid($row->state_id)
              ->setDatevisited($row->date_visited);
        $entries[] = $entry;
    }

    foreach($entries as $entryObj){
      $resultArray[] = [
        'id'           => $entryObj->Id,
        'person_id'    => $entryObj->Personid,
        'state_id'     => $entryObj->Stateid,
        'date_visited' => $entryObj->Datevisited
      ];
    }

    return $resultArray;
  }

}

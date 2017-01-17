<?php

class Application_Model_PeopleMapper
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
          $this->setDbTable('Application_Model_DbTable_People');
      }
      return $this->_dbTable;
  }

  public function save(Application_Model_DbTable_People $people)
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

  public function find($id, Application_Model_DbTable_People $people)
  {
      $result = $this->getDbTable()->find($people_id);
      if (0 == count($result)) {
          return;
      }
      $row = $result->current();
      $people->setId($row->people_id)
                ->setFirstname($row->first_name)
                ->setLastname($row->last_name)
                ->setFavoritefood($row->favorite_food);
  }

  public function fetchAll()
  {
      $resultSet = $this->getDbTable()->fetchAll();
      $entries   = array();
      foreach ($resultSet as $row) {
          $entry = new Application_Model_DbTable_People();
          $entry->setId($row->people_id)
                ->setFirstname($row->first_name)
                ->setLastname($row->last_name)
                ->setFavoriteFood($row->favorite_food);
          $entries[] = $entry;
      }
      return $entries;
  }

}

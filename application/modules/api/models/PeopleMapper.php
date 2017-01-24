<?php

class API_Model_PeopleMapper
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
          $this->setDbTable('API_Model_DbTable_People');
      }
      return $this->_dbTable;
  }

  public function save(API_Model_People $people)
  {
      $data = array(
          'people_id'     => $people->getPeopleid(),
          'first_name'    => $people->getFirstname(),
          'last_name'     => $people->getLastname(),
          'favorite_food' => $people->getFavoritefood()
      );

      if (null === ($people_id = $people->getPeopleid())) {
          unset($data['people_id']);
          $this->getDbTable()->insert($data);
      } else {
          $this->getDbTable()->update($data, array('people_id = ?' => $people_id));
      }
  }

  public function find($data)
  {

      $result = $this->getDbTable()->find($data);
      if (0 == count($result)){
        return;
      }
      $people = new API_Model_People();

      $row = $result->current();
      $people->setPeopleid($row->people_id)
             ->setFirstname($row->first_name)
             ->setLastname($row->last_name)
             ->setFavoriteFood($row->favorite_food);

      $resultArray[] =
      [
        'people_id'     => $people->Peopleid,
        'first_name'    => $people->Firstname,
        'last_name'     => $people->Lastname,
        'favorite_food' => $people->Favoritefood
      ];

      return $resultArray;
  }

  public function fetchAll()
  {
      $result = $this->getDbTable()->fetchAll();
      $entries = array();
      foreach ($result as $row) {
          $entry = new API_Model_People();
          $entry->setPeopleid($row->people_id)
                ->setFirstname($row->first_name)
                ->setLastname($row->last_name)
                ->setFavoriteFood($row->favorite_food);
          $entries[] = $entry;
      }

      foreach($entries as $entryObj){
        $resultArray[] = [
          'people_id'     => $entryObj->Peopleid,
          'first_name'    => $entryObj->Firstname,
          'last_name'     => $entryObj->Lastname,
          'favorite_food' => $entryObj->Favoritefood
        ];
      }
      return $resultArray;
  }
}

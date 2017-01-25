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

  public function save(API_Model_Visits $visits)
  {
      $data = array(
          'id'           => $visits->getId(),
          'person_id'    => $visits->getPersonid(),
          'state_id'     => $visits->getStateid(),
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
      $query = "SELECT
                  people.first_name,
                  people.last_name,
                  people.favorite_food,
                  states.states_name,
                  states.states_abbreviation,
                  visits.date_visited
                  FROM people
                  INNER JOIN visits ON visits.person_id = people.people_id
                  INNER JOIN states ON states.states_id = visits.state_id
                  WHERE people.people_id = '$data' ";

        $result = mysql_query($query);

        while($row = mysql_fetch_array($result)){
          $response[] = [
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'favorite_food' => $row['favorite_food'],
            'states_name' => $row['states_name'],
            'states_abbreviation' => $row['states_abbreviation'],
            'date_visited' => $row['date_visited']
          ];
        }

        if(empty($response))
        {
          $sql = "SELECT * FROM people
                    WHERE people_id = '$data' ";

          $r = mysql_query($sql);
          while($row = mysql_fetch_array($r)){
            $response[] = [
              'first_name' => $row['first_name'],
              'last_name' => $row['last_name'],
              'favorite_food' => $row['favorite_food'],
            ];
          }
          return $response;
        }else{
        return $response;
      }
      /*$result = $this->getDbTable()->fetchAll($data);
      $entries   = array();
      foreach ($result as $row) {
        $entry = new API_Model_Visits();
        $entry->setId($row->id)
              ->setPersonid($row->person_id)
              ->setStateid($row->state_id)
              ->setDatevisited($row->date_visited);
        $entries[] = $entry;
      }

      /*$visits = new API_Model_Visits();
      $states = new API_Model_StatesMapper();
      $resut = $states->find();

      echo json_encode($resut);
      die();

      foreach($entries as $entryObj){
        if($entryObj->Personid === $data){
          $resultArray[] = [
            'id'           => $entryObj->Id,
            'person_id'    => $entryObj->Personid,
            'state_id'     => $entryObj->Stateid,
            'date_visited' => $entryObj->Datevisited
          ];
        }
      }

      if(empty($resultArray))
        {
          return $resultArray = null;
        }
    return $resultArray;*/
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

<?php

class API_Model_Visits
{

      protected $date_visited;
      protected $state_id;
      protected $person_id;
      protected $id;

      public function __construct(array $options = null)
      {
          if (is_array($options)) {
              $this->setOptions($options);
          }
      }

      public function __set($name, $value)
      {
          $method = 'set' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid set Visits property');
          }
          $this->$method($value);
      }

      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid get Visits property');
          }
          return $this->$method();
      }

      public function setOptions(array $options)
      {
          $methods = get_class_methods($this);
          foreach ($options as $key => $value) {
              $method = 'set' . ucfirst($key);
              if (in_array($method, $methods)) {
                  $this->$method($value);
              }
          }
          return $this;
      }

      public function setDatevisited($date_visited)
      {
          $this->date_visited = (string)$date_visited;
          return $this;
      }

      public function getDatevisited()
      {
          return $this->date_visited;
      }

      public function setPersonid($person_id)
      {
          $this->person_id = (string)$person_id;
          return $this;
      }

      public function getPersonid()
      {
          return $this->person_id;
      }

      public function setStateid($state_id)
      {
          $this->state_id = (string)$state_id;
          return $this;
      }

      public function getStateid()
      {
          return $this->state_id;
      }

      public function setId($id)
      {
          $this->id = (int)$id;
          return $this;
      }

      public function getId()
      {
          return $this->id;
      }

}

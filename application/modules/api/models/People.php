<?php

class API_Model_People
{

      protected $favorite_food;
      protected $last_name;
      protected $first_name;
      protected $people_id;

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
              throw new Exception('Invalid set people property');
          }
          $this->$method($value);
      }

      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid get people property');
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

      public function setFavoritefood($favorite_food)
      {
          $this->favorite_food = (string)$favorite_food;
          return $this;
      }

      public function getFavoritefood()
      {
          return $this->favorite_food;
      }

      public function setLastname($last_name)
      {
          $this->last_name = (string)$last_name;
          return $this;
      }

      public function getLastname()
      {
          return $this->last_name;
      }

      public function setFirstname($first_name)
      {
          $this->first_name = (string)$first_name;
          return $this;
      }

      public function getFirstname()
      {
          return $this->first_name;
      }

      public function setPeopleid($people_id)
      {
          $this->people_id = (int)$people_id;
          return $this;
      }

      public function getPeopleid()
      {
          return $this->people_id;
      }

}

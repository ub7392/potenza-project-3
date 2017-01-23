<?php

class Api_Model_People
{

      protected $_favoritefood;
      protected $_lastname;
      protected $_firstname;
      protected $_peopleid;

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
              throw new Exception('Invalid people property');
          }
          $this->$method($value);
      }

      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid people property');
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
          $this->_favoritefood = (string)$favorite_food;
          return $this;
      }

      public function getFavoritefood()
      {
          return $this->_favoritefood;
      }

      public function setLastname($last_name)
      {
          $this->_lastname = (string)$last_name;
          return $this;
      }

      public function getLastname()
      {
          return $this->_lastname;
      }

      public function setFirstname($first_name)
      {
          $this->_firstname = (string)$first_name;
          return $this;
      }

      public function getFirstname()
      {
          return $this->_firstname;
      }

      public function setPeopleid($people_id)
      {
          $this->_peopleid = (int)$people_id;
          return $this;
      }

      public function getId()
      {
          return $this->_peopleid;
      }

}

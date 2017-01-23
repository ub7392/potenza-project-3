<?php

class Api_Model_States
{

      protected $_statesid;
      protected $_statesname;
      protected $_statesabbreviation;

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
              throw new Exception('Invalid States property');
          }
          $this->$method($value);
      }

      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid States property');
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

      public function setStatesid($states_id)
      {
          $this->_statesid = (string)$states_id;
          return $this;
      }

      public function getStatesid()
      {
          return $this->_statesid;
      }

      public function setStatename($states_name)
      {
          $this->_statesname = (string)$states_name;
          return $this;
      }

      public function getStatename()
      {
          return $this->_statesname;
      }

      public function setStatesabbreviation($states_abbreviation)
      {
          $this->_statesabbreviation = (string)$states_abbreviation;
          return $this;
      }

      public function getStatesabbreviation()
      {
          return $this->_statesabbreviation;
      }

}

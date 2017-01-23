<?php

class API_Model_States
{
      protected $states_id;
      protected $states_name;
      protected $states_abbreviation;

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
          $this->states_id = (string)$states_id;
          return $this;
      }

      public function getStatesid()
      {
          return $this->states_id;
      }

      public function setStatesname($states_name)
      {
          $this->states_name = (string)$states_name;
          return $this;
      }

      public function getStatesname()
      {
          return $this->states_name;
      }

      public function setStatesabbreviation($states_abbreviation)
      {
          $this->states_abbreviation = (string)$states_abbreviation;
          return $this;
      }

      public function getStatesabbreviation()
      {
          return $this->states_abbreviation;
      }

}

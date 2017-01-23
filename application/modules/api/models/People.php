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

	  /*
	   * Function names prefaced with '__' are magic methods reserved by PHP
	   * You can override them, to access private variables, methods
	   * http://php.net/manual/en/language.oop5.magic.php
	   */
      public function __get($name)
      {

		  /*
		   * If you want to use magic method, just return property
		   */
		  //return $this->$name;

		  /*
		   * Commented code looks for a method named 'getname' and tries
		   * to run it for each property passed, fails if no method exists
		   */

          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid get people property');
          }
		 
          return $this->$method();
      }


	  /**
	   * Method to get array object of a person
	   */
	  public function getPersonObject()
	  {
		  return [
			  'people_id' => $this->people_id,
			  'first_name' => $this->first_name,
			  'last_name' => $this->last_name,
			  'favorite_food' => $this->favorite_food,
		  ];

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

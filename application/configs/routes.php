<?php
  $route = new Zend_Controller_Router_Route(
  'api',
  array(
    'module'      => 'api',
    'controller'  => 'index',
    'action'      => 'index'
  ));
  $router->addroute('api', $route);

  //api/people
  $people = new Zend_Controller_Router_Route(
    'people',
    array(
      'module'      =>  'api',
      'controller'  =>  'people',
      'action'      =>  'index'
    )
  );
  $router->addroute('people', $people);

  //api/people/id
  $peopleid = new Zend_Controller_Router_Route(
    'api/people/:people_id',
    array(
      'module'      =>  'api',
      'controller'  =>  'people',
      'action'      =>  'get'
    )
  );
  $router->addroute('people_id', $peopleid);

  //api/states
  $states = new Zend_Controller_Router_Route(
    'api/states',
    array(
      'module'      =>  'api',
      'controller'  =>  'states',
      'action'      =>  'index'
    )
  );
  $router->addroute('states', $states);

  //api/states/id
  $statesid = new Zend_Controller_Router_Route(
    'api/states/:states_id',
    array(
      'module'      =>  'api',
      'controller'  =>  'states',
      'action'      =>  'get'
    )
  );
  $router->addroute('states_id', $statesid);

  //api/visits
  $visits = new Zend_Controller_Router_Route(
    'api/visits',
    array(
      'module'      =>  'api',
      'controller'  =>  'visits',
      'action'      =>  'index'
    )
  );
  $router->addroute('visits', $visits);

  //api/visits/id
  $visitsid = new Zend_Controller_Router_Route(
    'api/visits/:visits_id',
    array(
      'module'      =>  'api',
      'controller'  =>  'visits',
      'action'      =>  'get'
    )
  );
  $router->addroute('visits_id', $visitsid);

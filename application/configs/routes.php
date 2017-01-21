<?php
$route = new Zend_Controller_Router_Route(
  'api',
  array(
    'module'      => 'api',
    'controller'  => 'index',
    'action'      => 'index'
  )
);
$router->addroute('api', $route);

//api/people
$people = new Zend_Controller_Router_Route(
  'api/people',
  array(
    'module'      =>  'api',
    'controller'  =>  'people',
    'action'      =>  'index'
  )
);
$router->addroute('people', $people);

//api/people/id
$peopleid = new Zend_Controller_Router_Route(
  'api/people/',
  array(
    'module'      =>  'api',
    'controller'  =>  'people',
    'action'      =>  'get'
  )
);
$router->addroute('peopleid', $peopleid);

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
  'api/states/:id',
  array(
    'module'      =>  'api',
    'controller'  =>  'states',
    'action'      =>  'get'
  )
);
$router->addroute('statesid', $statesid);

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
  'api/visits/:id',
  array(
    'module'      =>  'api',
    'controller'  =>  'visits',
    'action'      =>  'get'
  )
);
$router->addroute('id', $visitsid);

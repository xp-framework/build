<?php 


 class ApiInformation extends Object{





public function welcome(){
return 




array('message' => 'Welcome to the XP Framework Build API','version' => '1.0.0','_links' => array('self' => array('href' => '/',),'vendors' => array('href' => '/{vendor}','templated' => TRUE,),),);}}xp::$registry['class.ApiInformation']= 'net.xp_framework.build.api.ApiInformation';xp::$registry['details.net.xp_framework.build.api.ApiInformation']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'welcome' => 
    array (
      1 => 
      array (
      ),
      2 => 'var',
      3 => 
      array (
      ),
      4 => 'Shows API information',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/',
          'returns' => 'application/hal+json',
        ),
      ),
      6 => 
      array (
      ),
    ),
  ),
  'class' => 
  array (
    5 => 
    array (
      'webservice' => NULL,
    ),
    4 => NULL,
  ),
);
?>
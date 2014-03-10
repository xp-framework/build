<?php namespace net\xp_framework\build\api;

;
;
;





class ApiInformation extends \lang\Object{
const VERSION='2.0.0';







public function specification(){
$apis=array();
foreach ($this->getClass()->getPackage()->getClasses() as $class) {
if (!$class->hasAnnotation('webservice')) {continue;};
$webservice=$class->getAnnotation('webservice');


$routing=array();
foreach ($class->getMethods() as $method) {
if (!$method->hasAnnotation('webmethod')) {continue;};
$webmethod=$method->getAnnotation('webmethod');
$path=implode('/',array('',trim($webservice['path'],'/'),trim($webmethod['path'],'/'),));









$routing[$path][$webmethod['verb']]=array('method' => $webmethod['verb'],'nickname' => $method->getName(),'summary' => $method->getComment(),'notes' => '','type' => 'object','parameters' => array(),'responseMessages' => array(),'errorResponses' => array(),);};


foreach ($routing as $path => $operations) {




$apis[]=array('path' => $path,'description' => ''.$class->getComment(),'operations' => array_values($operations),);};};



return 
array('apiVersion' => \net\xp_framework\build\api\ApiInformation::VERSION,'swaggerVersion' => 
'1.2','basePath' => 
'http://builds.planet-xp.net','resourcePath' => 
'/','apis' => 
$apis,);}









public function welcome(){
return 





array('message' => 'Welcome to the XP Framework Build API','version' => \net\xp_framework\build\api\ApiInformation::VERSION,'_links' => array('self' => array('href' => '/',),'search' => array('href' => '/search?q={query}','templated' => TRUE,),'vendors' => array('href' => '/vendors',),),);}}\xp::$cn['net\xp_framework\build\api\ApiInformation']= 'net.xp_framework.build.api.ApiInformation';\xp::$meta['net.xp_framework.build.api.ApiInformation']= array(0 => array(), 1 => array('specification' => array(1 => array(), 2 => 'var', 3 => array(), 4 => 'Shows API information using Swagger API', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/', 'returns' => 'application/json')), 6 => array()), 'welcome' => array(1 => array(), 2 => 'var', 3 => array(), 4 => 'Shows API information using Hypertext Application Language', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/', 'returns' => 'application/hal+json')), 6 => array())), 'class' => array(4 => 'The "/" resource shows information about the API', 5 => array('webservice' => NULL), 6 => array()));
?>

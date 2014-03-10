<?php namespace net\xp_framework\build\api;

;
;

;




class IsModule extends \lang\Object implements \io\collections\iterate\IterationFilter{
const NAME='module.json';




public function accept($e){
return \net\xp_framework\build\api\IsModule::NAME === basename($e->getURI());}}\xp::$cn['net\xp_framework\build\api\IsModule']= 'net.xp_framework.build.api.IsModule';\xp::$meta['net.xp_framework.build.api.IsModule']= array(0 => array(), 1 => array('accept' => array(1 => array(0 => 'io.collections.IOElement'), 2 => 'bool', 3 => array(), 4 => 'Returns whether the given IOElement applies', 5 => array(), 6 => array())), 'class' => array(4 => 'Searches for modules', 5 => array(), 6 => array()));
?>

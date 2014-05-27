<?php namespace net\xp_framework\build;

class BuildInstructionsTest extends \unittest\TestCase{








protected function assertAccessors(\lang\Generic $instance,$member,$value){



$class=$instance->getClass();$class->getMethod('set'.$member)->invoke($instance,array($value,));$this->assertEquals($value,$class->getMethod('get'.$member)->invoke($instance,array()));;}


public function can_create(){
new \net\xp_framework\build\BuildInstructions();}


public function base_accessors(){
$this->assertAccessors(new \net\xp_framework\build\BuildInstructions(),'base','.');}


public function naming_accessors(){
$this->assertAccessors(new \net\xp_framework\build\BuildInstructions(),'naming',array('name' => 'test',));}


public function finalize_accessors(){
$this->assertAccessors(new \net\xp_framework\build\BuildInstructions(),'finalize','test');}}\xp::$cn['net\xp_framework\build\BuildInstructionsTest']= 'net.xp_framework.build.BuildInstructionsTest';\xp::$meta['net.xp_framework.build.BuildInstructionsTest']= array(0 => array(), 1 => array('assertAccessors' => array(1 => array(0 => 'lang.Generic', 1 => 'string', 2 => 'var'), 2 => 'void', 3 => array(), 4 => 'Test accessors for a given member (getX and setX).', 5 => array(), 6 => array()), 'can_create' => array(1 => array(), 2 => 'void', 3 => array(), 4 => NULL, 5 => array('test' => NULL), 6 => array()), 'base_accessors' => array(1 => array(), 2 => 'void', 3 => array(), 4 => NULL, 5 => array('test' => NULL), 6 => array()), 'naming_accessors' => array(1 => array(), 2 => 'void', 3 => array(), 4 => NULL, 5 => array('test' => NULL), 6 => array()), 'finalize_accessors' => array(1 => array(), 2 => 'void', 3 => array(), 4 => NULL, 5 => array('test' => NULL), 6 => array())), 'class' => array(4 => NULL, 5 => array(), 6 => array()));
?>

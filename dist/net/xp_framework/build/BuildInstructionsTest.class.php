<?php uses('unittest.TestCase', 'net.xp_framework.build.BuildInstructions');

 class BuildInstructionsTest extends TestCase{

public function can_create(){
new BuildInstructions();}


public function base_accessors(){
$base='.';
$b=new BuildInstructions();
$b->setBase($base);
$this->assertEquals($base,$b->getBase());}


public function naming_accessors(){
$naming=array('name' => 'test',);
$b=new BuildInstructions();
$b->setNaming($naming);
$this->assertEquals($naming,$b->getNaming());}


public function finalize_accessors(){
$finalize='test';
$b=new BuildInstructions();
$b->setFinalize($finalize);
$this->assertEquals($finalize,$b->getFinalize());}}xp::$cn['BuildInstructionsTest']= 'net.xp_framework.build.BuildInstructionsTest';xp::$meta['net.xp_framework.build.BuildInstructionsTest']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'can_create' => 
    array (
      1 => 
      array (
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
        'test' => NULL,
      ),
      6 => 
      array (
      ),
    ),
    'base_accessors' => 
    array (
      1 => 
      array (
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
        'test' => NULL,
      ),
      6 => 
      array (
      ),
    ),
    'naming_accessors' => 
    array (
      1 => 
      array (
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
        'test' => NULL,
      ),
      6 => 
      array (
      ),
    ),
    'finalize_accessors' => 
    array (
      1 => 
      array (
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
        'test' => NULL,
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
    ),
    4 => NULL,
  ),
);
?>

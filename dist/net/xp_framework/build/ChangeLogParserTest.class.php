<?php uses('unittest.TestCase', 'net.xp_framework.build.ChangeLogParser', 'io.streams.MemoryInputStream');

abstract  class ChangeLogParserTest extends TestCase{




protected abstract function newFixture();




protected function parse($in){
return $this->newFixture()->parse(new MemoryInputStream($in));}}xp::$cn['ChangeLogParserTest']= 'net.xp_framework.build.ChangeLogParserTest';xp::$meta['net.xp_framework.build.ChangeLogParserTest']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'newFixture' => 
    array (
      1 => 
      array (
      ),
      2 => 'net.xp_framework.build.ChangeLogParser',
      3 => 
      array (
      ),
      4 => 'Creates a new fixture',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'parse' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'net.xp_framework.build.ChangeLog',
      3 => 
      array (
      ),
      4 => 'Parses a changeLog in string form',
      5 => 
      array (
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

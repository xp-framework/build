<?php uses('unittest.TestCase', 'net.xp_framework.build.ChangeLogParser', 'io.streams.MemoryInputStream', 'net.xp_framework.build.ChangeLog', 'net.xp_framework.build.Release', 'util.Date', 'net.xp_framework.build.Version');

 class ChangeLogParserTest extends TestCase{

public function one_release_and_dev_version(){


















$changeLog=create(new ChangeLogParser())->parse(new MemoryInputStream('
Version ?.?.?, released ????-??-??
----------------------------------
Git commit: ?????

Features
~~~~~~~~
- Added support for "self" keyword in parameters and return types
  (friebe)

Version 1.2.0, released 2012-09-30
----------------------------------
Git commit: 27e33c1b3a01127a4398f2e9a3884b6426bf4cff

Features
~~~~~~~~
- Fix issue #302
  (friebe)
    '));$this->assertEquals(create(new ChangeLog())->withRelease(new Release(NULL,Date::now(),'?????','
Features
~~~~~~~~
- Added support for "self" keyword in parameters and return types
  (friebe)
        '))->withRelease(new Release(new Version('1.2.0'),new Date('2012-09-30'),'27e33c1b3a01127a4398f2e9a3884b6426bf4cff','
Features
~~~~~~~~
- Fix issue #302
  (friebe)
        ')),$changeLog);}}xp::$cn['ChangeLogParserTest']= 'net.xp_framework.build.ChangeLogParserTest';xp::$meta['net.xp_framework.build.ChangeLogParserTest']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'one_release_and_dev_version' => 
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

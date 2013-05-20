<?php uses('unittest.TestCase', 'net.xp_framework.build.MarkdownChangeLogParser', 'io.streams.MemoryInputStream', 'net.xp_framework.build.ChangeLog', 'net.xp_framework.build.Release', 'util.Date', 'net.xp_framework.build.Version');

 class MarkdownChangeLogParserTest extends TestCase{

public function one_release_and_dev_version(){













$changeLog=create(new MarkdownChangeLogParser())->parse(new MemoryInputStream('
## ?.?.? / ????-??-??

### RFCs

* Implemented RFC 273: ChangeLog formatting - (@thekid)

## 5.9.2 / 2013-05-16

### Heads up!

* Deprecated scriptlet.xml.workflow.casters.ToFloat in favor of ToDouble
  for the sake of consistency - (@thekid)
    '));$this->assertEquals(create(new ChangeLog())->withRelease(new Release(NULL,Date::now(),NULL,'
### RFCs

* Implemented RFC 273: ChangeLog formatting - (@thekid)
        '))->withRelease(new Release(new Version('5.9.2'),new Date('2013-05-16'),NULL,'
### Heads up!

* Deprecated scriptlet.xml.workflow.casters.ToFloat in favor of ToDouble
  for the sake of consistency - (@thekid)
        ')),$changeLog);}}xp::$cn['MarkdownChangeLogParserTest']= 'net.xp_framework.build.MarkdownChangeLogParserTest';xp::$meta['net.xp_framework.build.MarkdownChangeLogParserTest']= array (
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

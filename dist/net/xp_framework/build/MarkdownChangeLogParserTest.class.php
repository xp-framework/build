<?php namespace net\xp_framework\build;

class MarkdownChangeLogParserTest extends \net\xp_framework\build\ChangeLogParserTest{




protected function newFixture(){return new \net\xp_framework\build\MarkdownChangeLogParser();}

public function one_release_and_dev_version(){













$changeLog=$this->parse('
## ?.?.? / ????-??-??

### RFCs

* Implemented RFC 273: ChangeLog formatting - (@thekid)

## 5.9.2 / 2013-05-16

### Heads up!

* Deprecated scriptlet.xml.workflow.casters.ToFloat in favor of ToDouble
  for the sake of consistency - (@thekid)
    ');$this->assertEquals(create(new \net\xp_framework\build\ChangeLog())->withRelease(new \net\xp_framework\build\Release(NULL,\util\Date::now(),NULL,'
### RFCs

* Implemented RFC 273: ChangeLog formatting - (@thekid)
        '))->withRelease(new \net\xp_framework\build\Release(new \net\xp_framework\build\Version('5.9.2'),new \util\Date('2013-05-16'),NULL,'
### Heads up!

* Deprecated scriptlet.xml.workflow.casters.ToFloat in favor of ToDouble
  for the sake of consistency - (@thekid)
        ')),$changeLog);}}\xp::$cn['net\xp_framework\build\MarkdownChangeLogParserTest']= 'net.xp_framework.build.MarkdownChangeLogParserTest';\xp::$meta['net.xp_framework.build.MarkdownChangeLogParserTest']= array(0 => array(), 1 => array('newFixture' => array(1 => array(), 2 => 'net.xp_framework.build.ChangeLogParser', 3 => array(), 4 => 'Creates a new fixture', 5 => array(), 6 => array()), 'one_release_and_dev_version' => array(1 => array(), 2 => 'void', 3 => array(), 4 => NULL, 5 => array('test' => NULL), 6 => array())), 'class' => array(4 => NULL, 5 => array(), 6 => array()));
?>

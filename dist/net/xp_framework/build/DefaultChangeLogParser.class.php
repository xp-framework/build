<?php namespace net\xp_framework\build;

;
;
;

;
;






















class DefaultChangeLogParser extends \lang\Object implements \net\xp_framework\build\ChangeLogParser{




public function parse(\io\streams\InputStream $in){
$log=new \net\xp_framework\build\ChangeLog();




































$reader=new \io\streams\TextReader($in,'utf-8');$··e= NULL; try {$separator='Version %[0-9?.], released %[0-9?-]';$version=$date=NULL;do {if (NULL === ($l=$reader->readLine())) {throw new \lang\IllegalStateException('ChangeLog malformed');};} while (2 !== sscanf($l,$separator,$version,$date));;do {$release=new \net\xp_framework\build\Release();$release->setVersion('?.?.?' === $version?NULL:new \net\xp_framework\build\Version($version));$release->setDate('????-??-??' === $date?\util\Date::now():new \util\Date($date));$reader->readLine();$rev=NULL;sscanf($reader->readLine(),'%*[^:]: %s',$rev);$release->setRevision($rev);$notes='';$version=$date=NULL;while (NULL !== ($l=$reader->readLine())) {if (2 === sscanf($l,$separator,$version,$date)) {break;};$notes.=$l.'
';};$release->setNotes(rtrim($notes,'
'));$log->addRelease($release);} while (NULL !== $l);;} catch (\Exception$··e) {}try { $reader->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;return $log;}}\xp::$cn['net\xp_framework\build\DefaultChangeLogParser']= 'net.xp_framework.build.DefaultChangeLogParser';\xp::$meta['net.xp_framework.build.DefaultChangeLogParser']= array(0 => array(), 1 => array('parse' => array(1 => array(0 => 'io.streams.InputStream'), 2 => 'net.xp_framework.build.ChangeLog', 3 => array(), 4 => 'Parse ChangeLog file', 5 => array(), 6 => array())), 'class' => array(4 => 'Parses changelog from an input stream

Example:
```
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

...
```', 5 => array(), 6 => array()));
?>

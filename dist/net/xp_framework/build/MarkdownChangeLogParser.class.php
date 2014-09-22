<?php namespace net\xp_framework\build;

;
;
;

;
;






















class MarkdownChangeLogParser extends \lang\Object implements \net\xp_framework\build\net\xp_framework\build\ChangeLogParser{
const SEPARATOR='## %[0-9?.] / %[0-9?-]';




public function parse(\io\streams\InputStream $in){
$log=new \net\xp_framework\build\ChangeLog();




























$reader=new \io\streams\TextReader($in,'utf-8');$··e= NULL; try {$version=$date=NULL;do {if (NULL === ($l=$reader->readLine())) {throw new \lang\IllegalStateException('ChangeLog malformed');};} while (2 !== sscanf($l,\net\xp_framework\build\MarkdownChangeLogParser::SEPARATOR,$version,$date));;do {$release=new \net\xp_framework\build\Release();$release->setVersion('?.?.?' === $version?NULL:new \net\xp_framework\build\Version($version));$release->setDate('????-??-??' === $date?\util\Date::now():new \util\Date($date));$release->setRevision(NULL);$notes='';$version=$date=NULL;while (NULL !== ($l=$reader->readLine())) {if (2 === sscanf($l,\net\xp_framework\build\MarkdownChangeLogParser::SEPARATOR,$version,$date)) {break;};$notes.=$l.'
';};$release->setNotes(rtrim($notes,'
'));$log->addRelease($release);} while (NULL !== $l);;} catch (\Exception$··e) {}try { $reader->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;return $log;}}\xp::$cn['net\xp_framework\build\MarkdownChangeLogParser']= 'net.xp_framework.build.MarkdownChangeLogParser';\xp::$meta['net.xp_framework.build.MarkdownChangeLogParser']= array(0 => array(), 1 => array('parse' => array(1 => array(0 => 'io.streams.InputStream'), 2 => 'net.xp_framework.build.ChangeLog', 3 => array(), 4 => 'Parse ChangeLog file', 5 => array(), 6 => array())), 'class' => array());
?>

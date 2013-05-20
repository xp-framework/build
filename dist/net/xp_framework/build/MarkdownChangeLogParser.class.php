<?php uses('util.Date', 'io.streams.InputStream', 'io.streams.TextReader', 'net.xp_framework.build.ChangeLog', 'net.xp_framework.build.Release', 'net.xp_framework.build.Version');

;
;
;

;
;






















 class MarkdownChangeLogParser extends Object{
const SEPARATOR='## %[0-9?.] / %[0-9?-]';




public function parse(InputStream $in){
$log=new ChangeLog();




























$reader=new TextReader($in,'utf-8');$··e= NULL; try {$version=$date=NULL;do {if (NULL === ($l=$reader->readLine())) {throw new IllegalStateException('ChangeLog malformed');};} while (2 !== sscanf($l,MarkdownChangeLogParser::SEPARATOR,$version,$date));;do {$release=new Release();$release->setVersion('?.?.?' === $version?NULL:new Version($version));$release->setDate('????-??-??' === $date?Date::now():new Date($date));$release->setRevision(NULL);$notes='';$version=$date=NULL;while (NULL !== ($l=$reader->readLine())) {if (2 === sscanf($l,MarkdownChangeLogParser::SEPARATOR,$version,$date)) {break;};$notes.=$l.'
';};$release->setNotes(rtrim($notes,'
'));$log->addRelease($release);} while (NULL !== $l);;} catch (Exception $··e) {}try { $reader->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;return $log;}}xp::$cn['MarkdownChangeLogParser']= 'net.xp_framework.build.MarkdownChangeLogParser';xp::$meta['net.xp_framework.build.MarkdownChangeLogParser']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'parse' => 
    array (
      1 => 
      array (
        0 => 'io.streams.InputStream',
      ),
      2 => 'net.xp_framework.build.ChangeLog',
      3 => 
      array (
      ),
      4 => 'Parse ChangeLog file',
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
    4 => 'Parses markdown changelog from an input stream

Example:
```markdown
## ?.?.? / ????-??-??

### RFCs

* Implemented RFC 273: ChangeLog formatting - (@thekid)

## 5.9.2 / 2013-05-16

### Heads up!

* Deprecated scriptlet.xml.workflow.casters.ToFloat in favor of ToDouble
  for the sake of consistency - (@thekid)

...
```',
  ),
);
?>

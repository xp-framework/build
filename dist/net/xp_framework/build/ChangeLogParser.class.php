<?php uses('io.streams.InputStream');








 interface ChangeLogParser {




public function parse(InputStream $in);}xp::$cn['ChangeLogParser']= 'net.xp_framework.build.ChangeLogParser';xp::$meta['net.xp_framework.build.ChangeLogParser']= array (
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
    4 => 'Parses changelog from an input stream',
  ),
);
?>

<?php 

;
;




$package= 'net.xp_framework.build.api'; class net·xp_framework·build·api·Filter extends Object{
public $pattern;




public function __construct($pattern){
$this->pattern=$pattern;}





public static function valueOf($in){
return new net·xp_framework·build·api·Filter('/^'.strtr(preg_quote($in,'/'),array('\\*' => '.+',)).'$/');}}xp::$cn['net·xp_framework·build·api·Filter']= 'net.xp_framework.build.api.Filter';xp::$meta['net.xp_framework.build.api.Filter']= array (
  0 => 
  array (
    'pattern' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
  ),
  1 => 
  array (
    '__construct' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => NULL,
      3 => 
      array (
      ),
      4 => '
  
  Creates a new filter instance
  ',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'valueOf' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'net.xp_framework.build.api.Filter',
      3 => 
      array (
      ),
      4 => 'Creates a filter from input including wildcards',
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
    4 => 'Represents a filter for searching entities - e.g. modules, releases',
  ),
);
?>

<?php 





 class Link extends Object{
public $url;




public function __construct($url){
$this->url=$url;}





public static function valueOf($in){
return new Link($in);}






public function toString(){
return $this->getClassName().'(-> '.$this->url.')';}}xp::$registry['class.Link']= 'net.xp_framework.build.api.Link';xp::$registry['details.net.xp_framework.build.api.Link']= array (
  0 => 
  array (
    'url' => 
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
  
  Constructor
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
      2 => 'net.xp_framework.build.api.Link',
      3 => 
      array (
      ),
      4 => 'Deserialization',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'toString' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Creates a string representation',
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
    4 => 'Represents a link',
  ),
);
?>

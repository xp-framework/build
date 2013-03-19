<?php uses('io.File', 'io.Folder', 'net.xp_framework.build.ChangeLogParser');

;
;



 class BuildInstructions extends Object{
public static $DEFAULT;
protected $base= '.';
protected $names= array (
);



public function setBase($base){
$this->base=$base;}





public function getBase(){
return $this->base;}





public function setNames($names){
$this->names=$names;}





public function getNames(){
return $this->names;}





protected function baseOf(Folder $base){
return new Folder($base,$this->base);}





public function file(Folder $base,$name){
return new File($this->baseOf($base),$name);}





public function changeLogIn(Folder $base){
return create(new ChangeLogParser())->parse($this->file($base,'ChangeLog')->getInputStream());}





public function toString(){
return 


$this->getClassName().'@'.xp::stringOf(array('base' => $this->base,'names' => $this->names,));}static function __static() {BuildInstructions::$DEFAULT=new BuildInstructions();}}xp::$registry['class.BuildInstructions']= 'net.xp_framework.build.BuildInstructions';xp::$registry['details.net.xp_framework.build.BuildInstructions']= array (
  0 => 
  array (
    'DEFAULT' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.BuildInstructions',
      ),
    ),
    'base' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'names' => 
    array (
      5 => 
      array (
        'type' => '[:string]',
      ),
    ),
  ),
  1 => 
  array (
    'setBase' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets base',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getBase' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Returns base',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'setNames' => 
    array (
      1 => 
      array (
        0 => '[:string]',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets names',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getNames' => 
    array (
      1 => 
      array (
      ),
      2 => '[:string]',
      3 => 
      array (
      ),
      4 => 'Returns names',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'baseOf' => 
    array (
      1 => 
      array (
        0 => 'io.Folder',
      ),
      2 => 'io.Folder',
      3 => 
      array (
      ),
      4 => 'Base folder',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'file' => 
    array (
      1 => 
      array (
        0 => 'io.Folder',
        1 => 'string',
      ),
      2 => 'io.File',
      3 => 
      array (
      ),
      4 => 'Returns a file reference',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'changeLogIn' => 
    array (
      1 => 
      array (
        0 => 'io.Folder',
      ),
      2 => 'net.xp_framework.build.ChangeLog',
      3 => 
      array (
      ),
      4 => 'Returns the ChangeLog',
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
    4 => '',
  ),
);
?>

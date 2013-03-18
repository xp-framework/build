<?php 

;
;




 class Version extends Object{
protected $parts;
protected $rc= 0;
protected $branch= NULL;









public function __construct($number= NULL){if ($number === NULL) {return;};$this->parts=(array)sscanf($number,'%d.%d.%d%s');if (sizeof($this->parts) < 3) {throw new IllegalArgumentException('Cannot parse "'.$number.'": '.xp::stringOf($this->parts));};


if (NULL === $this->parts[3]) {}else {

if ('~' === $this->parts[3][0]) {

sscanf($this->parts[3],'~%[a-z]RC%d',$this->branch,$this->rc);}else {


sscanf($this->parts[3],'RC%d',$this->rc);};};}






public function getNumber(){
return sprintf(
'%d.%d.%d%s%s',
$this->parts[0],
$this->parts[1],
$this->parts[2],
$this->branch?'~'.$this->branch:'',

$this->rc > 0?'RC'.$this->rc:'');}





public function getSeries(){
return sprintf('%d.%d',$this->parts[0],$this->parts[1]);}





public function isReleaseCandidate(){
return $this->rc > 0;}





public function getReleaseVersion(){
if ($this->rc <= 0) {
throw new IllegalStateException('This is not a release candidate');};




$r=new Version();
$r->parts=$this->parts;
$r->branch=$this->branch;
$r->rc=0;
return $r;}





public function toString(){
return sprintf(
'%s<%d.%d.%d%s%s>',
$this->getClassName(),
$this->parts[0],
$this->parts[1],
$this->parts[2],
$this->branch?', '.$this->branch.' branch':'',

$this->rc?', release candidate #'.$this->rc:'');}





public function equals($cmp){if (NULL !== $cmp && !is("var", $cmp)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of var, ".xp::typeOf($cmp)." given");
return (




$cmp instanceof Version&&$this->parts === $cmp->parts&&$this->rc === $cmp->rc&&$this->branch === $cmp->branch);}}xp::$registry['class.Version']= 'net.xp_framework.build.Version';xp::$registry['details.net.xp_framework.build.Version']= array (
  0 => 
  array (
    'parts' => 
    array (
      5 => 
      array (
        'type' => 'var[]',
      ),
    ),
    'rc' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'branch' => 
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
    'getNumber' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Returns version number',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getSeries' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Returns the series (major.minor)',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'isReleaseCandidate' => 
    array (
      1 => 
      array (
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Returns whether this is a release candidate',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getReleaseVersion' => 
    array (
      1 => 
      array (
      ),
      2 => 'net.xp_framework.build.Version',
      3 => 
      array (
      ),
      4 => 'Gets release version if this is a release candidate',
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
      4 => 'Returns a string representation',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'equals' => 
    array (
      1 => 
      array (
        0 => 'var',
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Checks whether another object is equal to this',
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
    4 => 'Version',
  ),
);
?>

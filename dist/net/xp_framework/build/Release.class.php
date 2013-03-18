<?php uses('util.Date', 'net.xp_framework.build.Version');

;

;
;




 class Release extends Object{
protected $version;
protected $revision;
protected $date;
protected $notes;




public function setVersion(Version $version= NULL){
$this->version=$version;}





public function getVersion(){
return $this->version;}





public function setRevision($revision){if (NULL !== $revision && !is("string", $revision)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($revision)." given");
$this->revision=$revision;}





public function getRevision(){
return $this->revision;}







public function setDate(Date $date){
$this->date=$date;}





public function getDate(){
return $this->date;}





public function setNotes($notes){if (NULL !== $notes && !is("string", $notes)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($notes)." given");
$this->notes=$notes;}





public function getNotes(){
return $this->notes;}







public function toString(){
return sprintf(
'%s<%s %s @ %s> {
  %s
}',$this->getClassName(),NULL === $this->version?'?.?.?':$this->version->getNumber(),
$this->revision,
xp::stringOf($this->date),
str_replace('
','
  ',$this->notes));}}xp::$registry['class.Release']= 'net.xp_framework.build.Release';xp::$registry['details.net.xp_framework.build.Release']= array (
  0 => 
  array (
    'version' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.Version',
      ),
    ),
    'revision' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'date' => 
    array (
      5 => 
      array (
        'type' => 'util.Date',
      ),
    ),
    'notes' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
  ),
  1 => 
  array (
    'setVersion' => 
    array (
      1 => 
      array (
        0 => 'net.xp_framework.build.Version',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Set version',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getVersion' => 
    array (
      1 => 
      array (
      ),
      2 => 'net.xp_framework.build.Version',
      3 => 
      array (
      ),
      4 => 'Get version',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'setRevision' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Set revision',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getRevision' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Get revision',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'setDate' => 
    array (
      1 => 
      array (
        0 => 'util.Date',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Set date',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getDate' => 
    array (
      1 => 
      array (
      ),
      2 => 'util.Date',
      3 => 
      array (
      ),
      4 => 'Get date',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'setNotes' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Set notes',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getNotes' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Get notes',
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
  ),
  'class' => 
  array (
    5 => 
    array (
    ),
    4 => 'Represents a release',
  ),
);
?>

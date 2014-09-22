<?php namespace net\xp_framework\build;

;
;

;
;
;




class Release extends \lang\Object{
protected $version;
protected $revision;
protected $date;
protected $notes;




public function __construct($version= NULL,$date= NULL,$revision= NULL,$notes= NULL){$this->version= $version;$this->date= $date;$this->revision= $revision;
$this->setNotes($notes);}





public function setVersion($version= NULL){$this->version= $version;}




public function getVersion(){return $this->version;}




public function setRevision($revision){$this->revision= $revision;}




public function getRevision(){return $this->revision;}




public function setDate($date){$this->date= $date;}




public function getDate(){return $this->date;}




public function setNotes($notes){
$this->notes=trim($notes);}





public function getNotes(){return $this->notes;}




public function equals($cmp){if (NULL !== $cmp && !is("var", $cmp)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of var, ".\xp::typeOf($cmp)." given");
return (





$this instanceof \net\xp_framework\build\Release&&\util\Objects::equal($this->version,$cmp->version)&&\util\Objects::equal($this->revision,$cmp->revision)&&\util\Objects::equal($this->date,$cmp->date)&&\util\Objects::equal($this->notes,$cmp->notes));}





public function toString(){
return sprintf(
'%s<%s %s @ %s> {
  %s
}',$this->getClassName(),NULL === $this->version?'?.?.?':$this->version->getNumber(),
$this->revision,
\xp::stringOf($this->date),
str_replace('
','
  ',$this->notes));}}\xp::$cn['net\xp_framework\build\Release']= 'net.xp_framework.build.Release';\xp::$meta['net.xp_framework.build.Release']= array(0 => array('version' => array(5 => array('type' => 'net.xp_framework.build.Version'), 4 => NULL, 6 => array()), 'revision' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'date' => array(5 => array('type' => 'util.Date'), 4 => NULL, 6 => array()), 'notes' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array())), 1 => array('__construct' => array(1 => array(0 => 'net.xp_framework.build.Version', 1 => 'util.Date', 2 => 'string', 3 => 'string'), 2 => NULL, 3 => array(), 4 => 'Constructor', 5 => array(), 6 => array()), 'setVersion' => array(1 => array(0 => 'net.xp_framework.build.Version'), 2 => 'void', 3 => array(), 4 => 'Set version', 5 => array(), 6 => array()), 'getVersion' => array(1 => array(), 2 => 'net.xp_framework.build.Version', 3 => array(), 4 => 'Get version', 5 => array(), 6 => array()), 'setRevision' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Set revision', 5 => array(), 6 => array()), 'getRevision' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Get revision', 5 => array(), 6 => array()), 'setDate' => array(1 => array(0 => 'util.Date'), 2 => 'void', 3 => array(), 4 => 'Set date', 5 => array(), 6 => array()), 'getDate' => array(1 => array(), 2 => 'util.Date', 3 => array(), 4 => 'Get date', 5 => array(), 6 => array()), 'setNotes' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Set notes', 5 => array(), 6 => array()), 'getNotes' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Get notes', 5 => array(), 6 => array()), 'equals' => array(1 => array(0 => 'var'), 2 => 'bool', 3 => array(), 4 => 'Returns whether another object is equal to this release', 5 => array(), 6 => array()), 'toString' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Returns a string representation', 5 => array(), 6 => array())), 'class' => array());
?>

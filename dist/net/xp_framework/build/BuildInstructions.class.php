<?php namespace net\xp_framework\build;

;
;















class BuildInstructions extends \lang\Object{
public static $DEFAULT;



public static $changeLogs;
protected $base= '.';
protected $naming= array (
);protected $finalize= NULL;




public function setBase($base){$this->base= $base;}




public function getBase(){return $this->base;}




public function setNaming($naming){$this->naming= $naming;}




public function getNaming(){return $this->naming;}




public function setFinalize($finalize){$this->finalize= $finalize;}




public function getFinalize(){return $this->finalize;}




protected function baseOf(\io\Folder $base){
return new \io\Folder($base,$this->base);}





public function file(\io\Folder $base,$name){
return new \io\File($this->baseOf($base),$name);}





public function changeLogIn(\io\Folder $base){
foreach (\net\xp_framework\build\BuildInstructions::$changeLogs as $name => $parser) {
$f=$this->file($base,$name);
if ($f->exists()) {return $parser->parse($f->getInputStream());};};

return NULL;}





public function toString(){
return 



$this->getClassName().'@'.\xp::stringOf(array('base' => $this->base,'naming' => $this->naming,'finalize' => $this->finalize,));}static function __static() {\net\xp_framework\build\BuildInstructions::$DEFAULT=new \net\xp_framework\build\BuildInstructions();\net\xp_framework\build\BuildInstructions::$changeLogs=array('ChangeLog.md' => new \net\xp_framework\build\MarkdownChangeLogParser(),'ChangeLog' => new \net\xp_framework\build\DefaultChangeLogParser(),);}}\xp::$cn['net\xp_framework\build\BuildInstructions']= 'net.xp_framework.build.BuildInstructions';\xp::$meta['net.xp_framework.build.BuildInstructions']= array(0 => array('DEFAULT' => array(5 => array('type' => 'net.xp_framework.build.BuildInstructions'), 4 => NULL, 6 => array()), 'changeLogs' => array(5 => array('type' => '[:net.xp_framework.build.ChangeLogParser]'), 4 => NULL, 6 => array()), 'base' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'naming' => array(5 => array('type' => '[:string]'), 4 => NULL, 6 => array()), 'finalize' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array())), 1 => array('setBase' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets base', 5 => array(), 6 => array()), 'getBase' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Returns base', 5 => array(), 6 => array()), 'setNaming' => array(1 => array(0 => '[:string]'), 2 => 'void', 3 => array(), 4 => 'Sets naming', 5 => array(), 6 => array()), 'getNaming' => array(1 => array(), 2 => '[:string]', 3 => array(), 4 => 'Returns naming', 5 => array(), 6 => array()), 'setFinalize' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets finalize', 5 => array(), 6 => array()), 'getFinalize' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Returns finalize', 5 => array(), 6 => array()), 'baseOf' => array(1 => array(0 => 'io.Folder'), 2 => 'io.Folder', 3 => array(), 4 => 'Base folder', 5 => array(), 6 => array()), 'file' => array(1 => array(0 => 'io.Folder', 1 => 'string'), 2 => 'io.File', 3 => array(), 4 => 'Returns a file reference', 5 => array(), 6 => array()), 'changeLogIn' => array(1 => array(0 => 'io.Folder'), 2 => 'net.xp_framework.build.ChangeLog', 3 => array(), 4 => 'Returns the ChangeLog or NULL if no ChangeLog exists', 5 => array(), 6 => array()), 'toString' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Creates a string representation', 5 => array(), 6 => array())), 'class' => array(4 => 'Override build defaults via xpbuild.json:

```json
{
  "base"     : "core",
  "naming"   : {
    "main"     : "xp-rt-{VERSION}.xar",
    "test"     : "xp-test-{VERSION}.xar"
  },
  "finalize" : "XpRelease"
}
```', 5 => array(), 6 => array()));
?>

<?php namespace net\xp_framework\build\subscriber;

;
;
;
;
;
;
;

;
;
;













class XpReleaseFinalizer extends \lang\Object implements \net\xp_framework\build\subscriber\XarReleaseFinalizer{






protected function addIndex(\io\streams\FileOutputStream $ar,$arg,$name= NULL){if (NULL !== $arg && !is("var", $arg)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of var, ".\xp::typeOf($arg)." given");if (NULL !== $name && !is("string", $name)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".\xp::typeOf($name)." given");
if ($arg instanceof \io\File) {
$f=$arg;
$size=$f->size();
isset($name)||$name=$f->getFilename();
$stream=$f->getInputStream();}else {

$size=strlen($arg);
$stream=new \io\streams\MemoryInputStream($arg);};


$ar->write(sprintf('--%d:%s:--
',$size,$name));



$··e= NULL; try {while ($stream->available()) {$ar->write($stream->read());};} catch (\Exception$··e) {}try { $stream->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;}





public function finalize(array $build,array $archives,\io\Folder $targetDir){
$version=$build['release']['version'];
$baseDir=new \io\Folder($build['checkout'],$build['build']['base']);






$clIndex=create(new \io\File($targetDir,'lib.ar'))->getOutputStream();$··e= NULL; try {foreach ($archives as $entry) {$this->addIndex($clIndex,$entry->file,'lib/'.$entry->file->getFilename());};} catch (\Exception$··e) {}try { $clIndex->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;


$toolSrc=new \io\Folder($baseDir,'tools');




$tsIndex=create(new \io\File($targetDir,'tools.ar'))->getOutputStream();$··e= NULL; try {foreach (array('class.php','web.php','xar.php','lang.base.php',) as $tool) {$this->addIndex($tsIndex,new \io\File($toolSrc,$tool),'tools/'.$tool);};} catch (\Exception$··e) {}try { $tsIndex->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;




$dpIndex=create(new \io\File($targetDir,'depend.ar'))->getOutputStream();$··e= NULL; try {$this->addIndex($dpIndex,new \io\File('res',$version['series'].'-depend.ini'),'depend.ini');} catch (\Exception$··e) {}try { $dpIndex->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;


$testCfg=new \io\Folder($baseDir,'src','test','config','unittest');








$miIndex=create(new \io\File($targetDir,'meta-inf.ar'))->getOutputStream();$··e= NULL; try {$this->addIndex($miIndex,$build['release']['notes'],'ChangeLog');$this->addIndex($miIndex,'lib/'.$archives['main']->file->getFileName().'
','boot.pth');$config=new \io\collections\iterate\FilteredIOCollectionIterator(new \io\collections\FileCollection($testCfg),new \io\collections\iterate\ExtensionEqualsFilter('.ini'));foreach ($config as $ini) {$f=new \io\File($ini->getURI());$this->addIndex($miIndex,$f,'unittest/'.$f->getFileName());};} catch (\Exception$··e) {}try { $miIndex->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;




\io\FileUtil::setContents(new \io\File($targetDir,'setup'),str_replace('@@VERSION@@',$version['number'],\io\FileUtil::getContents(new \io\File('res',$version['series'].'-setup.php.in'))));}}\xp::$cn['net\xp_framework\build\subscriber\XpReleaseFinalizer']= 'net.xp_framework.build.subscriber.XpReleaseFinalizer';\xp::$meta['net.xp_framework.build.subscriber.XpReleaseFinalizer']= array(0 => array(), 1 => array('addIndex' => array(1 => array(0 => 'io.streams.FileOutputStream', 1 => 'var', 2 => 'string'), 2 => 'void', 3 => array(), 4 => 'Adds a file or a string to a given index', 5 => array(), 6 => array()), 'finalize' => array(1 => array(0 => '[:var]', 1 => '[:lang.archive.Archive]', 2 => 'io.Folder'), 2 => 'void', 3 => array(), 4 => 'Finalize', 5 => array(), 6 => array())), 'class' => array(4 => 'Creates XP .ar releases

<pre>
  [release]
  |- depend.ar     : depend.ini
  |- lib.ar        : xp-rt-[VERSION].xar xp-test-[VERSION].xar
  |- meta-inf.ar   : boot.pth ChangeLog unittest/*.ini
  |- tools         : class.php web.php xar.php lang.base.php
  `- setup         : Setup script
</pre>', 5 => array(), 6 => array()));
?>

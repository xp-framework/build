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




class XarRelease extends \net\xp_framework\build\subscriber\AbstractSubscriber{
private static $finalizers;



protected static $naming= array (
  'main' => 'xp-{MODULE}-{VERSION}.xar',
  'test' => 'xp-{MODULE}-test-{VERSION}.xar',
);private $release;



protected function origin(){
return 'build.xar';}





protected function destination(){
return NULL;}






public function useRelease(\util\Properties $prop){
$this->release=new \io\Folder($prop->readString('storage','folder','release'));}







protected function addAll(\lang\archive\Archive $archive,\io\collections\IOCollection $collection,$base){if (NULL !== $base && !is("string", $base)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".\xp::typeOf($base)." given");




$iterator=new \io\collections\iterate\FilteredIOCollectionIterator($collection,new \io\collections\iterate\NegationOfFilter(new \io\collections\iterate\CollectionFilter()),TRUE);
$i=0;
while ($iterator->hasNext()) {
$uri=$iterator->next()->getURI();
$urn=strtr(preg_replace('#^('.preg_quote($base,'#').'|/)#','',$uri),DIRECTORY_SEPARATOR,'/');
$archive->addFile($urn,new \io\File($uri));
$i++%10||$this->out->write('.');};}







public function createXarRelease(array $build){
$this->out->writeLine('---> ',$build['vendor'],'/',$build['module'],' R ',$build['release'],' @ ',$build['checkout']);
$version=$build['release']['version'];


$targetDir=new \io\Folder($this->release,$build['vendor'],$build['module'],$version['number']);
$targetDir->exists()||$targetDir->create(493);
$tempDir=new \io\Folder($targetDir,'tmp');
$tempDir->exists()||$tempDir->create(493);


$archives=array();
$baseDir=new \io\Folder($build['checkout'],$build['build']['base']);
foreach (array('main','test',) as $type) {
$srcDir=new \io\Folder($baseDir,'src',$type);



$archive=new \lang\archive\Archive(new \io\File($tempDir,strtr(isset($build['build']['naming'][$type])?$build['build']['naming'][$type]:\net\xp_framework\build\subscriber\XarRelease::$naming[$type],array('{MODULE}' => $build['module'],'{VERSION}' => $version['number'],))));
$archive->open(ARCHIVE_CREATE);
$this->out->writeLine('---> ',$archive);
foreach (new \io\collections\iterate\FilteredIOCollectionIterator(new \io\collections\FileCollection($srcDir),new \io\collections\iterate\CollectionFilter()) as $origin) {
$this->out->write('     >> Copy ',$origin,' [');
$this->addAll($archive,$origin,$origin->getURI());
$this->out->writeLine(']');};

$archive->addBytes('VERSION',$version['number']);
$archive->create();
$archives[$type]=$archive;};



$finalize=isset($build['build']['finalize'])?$build['build']['finalize']:'Default';
$this->out->writeLine('---> ',$finalize,'Finalizer');
try {
\net\xp_framework\build\subscriber\XarRelease::$finalizers->loadClass($finalize.'Finalizer')->newInstance()->finalize(
$build,
$archives,

$targetDir);} catch(\lang\reflect\TargetInvocationException $e) {

throw $e->getCause();};



$this->out->writeLine('---> ',$targetDir);
$tempDir->unlink();
$this->out->writeLine('===> Done');}static function __static() {\net\xp_framework\build\subscriber\XarRelease::$finalizers=\lang\reflect\Package::forName('net.xp_framework.build.subscriber');}}\xp::$cn['net\xp_framework\build\subscriber\XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';\xp::$meta['net.xp_framework.build.subscriber.XarRelease']= array(0 => array('finalizers' => array(5 => array('type' => 'lang.reflect.Package'), 4 => NULL, 6 => array()), 'naming' => array(5 => array('type' => '[:string]'), 4 => NULL, 6 => array()), 'release' => array(5 => array('type' => 'io.Folder'), 4 => NULL, 6 => array())), 1 => array('origin' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'React on builds', 5 => array(), 6 => array()), 'destination' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Does not publish a result', 5 => array(), 6 => array()), 'useRelease' => array(1 => array(0 => 'util.Properties'), 2 => 'void', 3 => array(), 4 => 'Injects xarrelease configuration', 5 => array('inject' => array('name' => 'xarrelease')), 6 => array()), 'addAll' => array(1 => array(0 => 'lang.archive.Archive', 1 => 'io.collections.IOCollection', 2 => 'string'), 2 => 'void', 3 => array(), 4 => 'Add all files from a given collection', 5 => array(), 6 => array()), 'createXarRelease' => array(1 => array(0 => '[:var]'), 2 => 'void', 3 => array(), 4 => 'Handler for messages', 5 => array('handler' => NULL), 6 => array())), 'class' => array(4 => 'Creates the .xar-based releases', 5 => array(), 6 => array()));
?>

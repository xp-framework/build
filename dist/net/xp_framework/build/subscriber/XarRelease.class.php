<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.FileUtil', 'io.streams.StreamTransfer', 'io.streams.MemoryInputStream', 'io.streams.TextReader', 'lang.archive.Archive', 'io.collections.IOCollection', 'io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.NegationOfFilter', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.ExtensionEqualsFilter', 'util.Date', 'util.Properties', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.collections.IOElement', 'io.streams.StringWriter');

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




 class XarRelease extends net·xp_framework·build·subscriber·AbstractSubscriber{
private static $finalizers;
private $release;




protected function origin(){
return 'build.xar';}





protected function destination(){
return NULL;}






public function useRelease(Properties $prop){
$this->release=new Folder($prop->readString('storage','folder','release'));}







protected function addAll(Archive $archive,IOCollection $collection,$base){if (NULL !== $base && !is("string", $base)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($base)." given");




$iterator=new FilteredIOCollectionIterator($collection,new NegationOfFilter(new CollectionFilter()),TRUE);
$i=0;
while ($iterator->hasNext()) {
$uri=$iterator->next()->getURI();
$urn=strtr(preg_replace('#^('.preg_quote($base,'#').'|/)#','',$uri),DIRECTORY_SEPARATOR,'/');
$archive->add(new File($uri),$urn);
$i++%10||$this->out->write('.');};}







public function createXarRelease(array $build){
$this->out->writeLine('---> ',$build['vendor'],'/',$build['module'],' REL ',$build['release'],' @ ',$build['checkout']);
$version=$build['release']['version'];


$targetDir=new Folder($this->release,$build['vendor'],$build['module'],$version['number']);
$targetDir->exists()||$targetDir->create(493);
$tempDir=new Folder($targetDir,'tmp');
$tempDir->exists()||$tempDir->create(493);


$archives=array();
$baseDir=new Folder($build['checkout'],$build['build']['base']);
foreach (array('main','test',) as $type) {
$srcDir=new Folder($baseDir,'src',$type);



$archive=new Archive(new File($tempDir,isset($build['build']['naming'][$type])?strtr($build['build']['naming'][$type],array('{VERSION}' => $version['number'],)).'.xar':'xp-'.$build['module'].'-'.$version['number'].'.xar'));
$archive->open(ARCHIVE_CREATE);
$this->out->writeLine('---> ',$archive);
foreach (new FilteredIOCollectionIterator(new FileCollection($srcDir),new CollectionFilter()) as $origin) {
$this->out->write('     >> Copy ',$origin,' [');
$this->addAll($archive,$origin,$origin->getURI());
$this->out->writeLine(']');};

$archive->addBytes('VERSION',$version['number']);
$archive->create();
$archives[$type]=$archive;};



$finalize=isset($build['build']['finalize'])?$build['build']['finalize']:'';
$this->out->writeLine('---> ',$finalize,'Finalizer');
try {
XarRelease::$finalizers->loadClass($finalize.'Finalizer')->newInstance()->finalize($build,$archives,$targetDir);} catch(TargetInvocationException $e) {

throw $e->getCause();};



$this->out->writeLine('---> ',$targetDir);
$tempDir->unlink();
$this->out->writeLine('===> Done');}static function __static() {XarRelease::$finalizers=Package::forName('net.xp_framework.build.subscriber');}}xp::$registry['class.XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';xp::$registry['details.net.xp_framework.build.subscriber.XarRelease']= array (
  0 => 
  array (
    'finalizers' => 
    array (
      5 => 
      array (
        'type' => 'lang.reflect.Package',
      ),
    ),
    'release' => 
    array (
      5 => 
      array (
        'type' => 'io.Folder',
      ),
    ),
  ),
  1 => 
  array (
    'origin' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'React on builds',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'destination' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Does not publish a result',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'useRelease' => 
    array (
      1 => 
      array (
        0 => 'util.Properties',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Injects xarrelease configuration',
      5 => 
      array (
        'inject' => 
        array (
          'name' => 'xarrelease',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'addAll' => 
    array (
      1 => 
      array (
        0 => 'lang.archive.Archive',
        1 => 'io.collections.IOCollection',
        2 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Add all files from a given collection',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'createXarRelease' => 
    array (
      1 => 
      array (
        0 => '[:var]',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Handler for messages',
      5 => 
      array (
        'handler' => NULL,
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
    4 => 'Creates the .xar-based releases',
  ),
);
?>

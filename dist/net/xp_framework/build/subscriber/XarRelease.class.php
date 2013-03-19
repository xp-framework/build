<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.FileUtil', 'io.streams.StreamTransfer', 'io.streams.MemoryInputStream', 'io.streams.TextReader', 'lang.archive.Archive', 'io.collections.IOCollection', 'io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.NegationOfFilter', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.ExtensionEqualsFilter', 'util.Date', 'util.Properties', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.streams.FileOutputStream', 'io.streams.InputStream', 'io.collections.IOElement', 'io.streams.StringWriter');

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
;
;
;
;
;
;




 class XarRelease extends net·xp_framework·build·subscriber·AbstractSubscriber{
private $release;




protected function origin(){
return 'build.xar';}





protected function destination(){
return NULL;}






public function useRelease(Properties $prop){
$this->release=new Folder($prop->readString('storage','folder','release'));}







protected function addIndex(FileOutputStream $ar,$arg,$name= NULL){if (NULL !== $arg && !is("var", $arg)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of var, ".xp::typeOf($arg)." given");if (NULL !== $name && !is("string", $name)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($name)." given");
if ($arg instanceof File) {
$f=$arg;
$size=$f->size();
isset($name)||$name=$f->getFilename();
$stream=$f->getInputStream();}else {

$size=strlen($arg);
$stream=new MemoryInputStream($arg);};


$ar->write(sprintf('--%d:%s:--
',$size,$name));



$··e= NULL; try {while ($stream->available()) {$ar->write($stream->read());};} catch (Exception $··e) {}try { $stream->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;}







protected function addAll(Archive $archive,IOCollection $collection,$base){if (NULL !== $base && !is("string", $base)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($base)." given");




$iterator=new FilteredIOCollectionIterator($collection,new NegationOfFilter(new CollectionFilter()),TRUE);
$i=0;
while ($iterator->hasNext()) {
$uri=$iterator->next()->getURI();
$urn=strtr(preg_replace('#^('.preg_quote($base,'#').'|/)#','',$uri),DIRECTORY_SEPARATOR,'/');
$archive->add(new File($uri),$urn);
$i++%10||$this->out->write('.');};}



protected function finalize(array $build,array $archives,Folder $targetDir){
foreach ($archives as $archive) {
$archive->file->move($targetDir);};}



protected function finalizeXpRelease(array $build,array $archives,Folder $targetDir){
$version=$build['release']['version'];
$baseDir=new Folder($build['checkout'],$build['build']['base']);







$clIndex=create(new File($targetDir,'lib.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$clIndex);foreach ($archives as $entry) {$this->addIndex($clIndex,$entry->file,'lib/'.$entry->file->getFilename());};} catch (Exception $··e) {}try { $clIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;


$toolSrc=new Folder($baseDir,'tools');





$tsIndex=create(new File($targetDir,'tools.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$tsIndex);foreach (array('class.php','web.php','xar.php','lang.base.php',) as $tool) {$this->addIndex($tsIndex,new File($toolSrc,$tool),'tools/'.$tool);};} catch (Exception $··e) {}try { $tsIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;





$dpIndex=create(new File($targetDir,'depend.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$dpIndex);$this->addIndex($dpIndex,new File('res',$version['series'].'-depend.ini'),'depend.ini');} catch (Exception $··e) {}try { $dpIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;


$testCfg=new Folder($baseDir,'src','test','config','unittest');










$miIndex=create(new File($targetDir,'meta-inf.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$tsIndex);$this->addIndex($miIndex,$build['release']['notes'],'ChangeLog');$this->addIndex($miIndex,'lib/'.$archives['main']->file->getFileName().'
','boot.pth');$config=new FilteredIOCollectionIterator(new FileCollection($testCfg),new ExtensionEqualsFilter('.ini'));foreach ($config as $ini) {$f=new File($ini->getURI());$this->addIndex($miIndex,$f,'unittest/'.$f->getFileName());$this->out->writeLine('     >> ',$f->getFileName());};} catch (Exception $··e) {}try { $miIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;




FileUtil::setContents(new File($targetDir,'setup'),str_replace('@@VERSION@@',$version['number'],FileUtil::getContents(new File('res',$version['series'].'-setup.php.in'))));}







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



$finalize=$this->getClass()->getMethod('finalize'.(isset($build['build']['finalize'])?$build['build']['finalize']:''));
try {
$finalize->invoke($this,array($build,$archives,$targetDir,));} catch(TargetInvocationException $e) {

throw $e->getCause();};



$this->out->writeLine('===> ',$targetDir);
$tempDir->unlink();
$this->out->writeLine('===> Done');}}xp::$registry['class.XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';xp::$registry['details.net.xp_framework.build.subscriber.XarRelease']= array (
  0 => 
  array (
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
    'addIndex' => 
    array (
      1 => 
      array (
        0 => 'io.streams.FileOutputStream',
        1 => 'var',
        2 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Adds a file or a string to a given index',
      5 => 
      array (
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
    'finalize' => 
    array (
      1 => 
      array (
        0 => '[:var]',
        1 => '[:lang.archive.Archive]',
        2 => 'io.Folder',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'finalizeXpRelease' => 
    array (
      1 => 
      array (
        0 => '[:var]',
        1 => '[:lang.archive.Archive]',
        2 => 'io.Folder',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => NULL,
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

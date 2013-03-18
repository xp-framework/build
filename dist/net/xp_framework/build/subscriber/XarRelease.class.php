<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.archive.zip.ZipFile', 'io.archive.zip.ZipArchiveReader', 'io.streams.StreamTransfer', 'io.streams.MemoryInputStream', 'io.streams.TextReader', 'lang.archive.Archive', 'io.collections.IOCollection', 'io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.NegationOfFilter', 'io.collections.iterate.CollectionFilter', 'net.xp_framework.build.Version', 'net.xp_framework.build.Release', 'net.xp_framework.build.ChangeLog', 'util.Date', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'peer.http.HttpResponse', 'io.streams.StringWriter', 'io.streams.FileOutputStream', 'io.streams.InputStream', 'io.collections.IOElement', 'io.archive.zip.ZipIterator', 'io.archive.zip.ZipDirEntry', 'io.archive.zip.ZipEntry');

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
;
;




 class XarRelease extends net·xp_framework·build·subscriber·AbstractSubscriber{



const ZIPBALL='https://github.com/%s/%s/zipball/%s';
const CHANGELOG='https://raw.github.com/%s/%s/%s/core/ChangeLog';

private $tmp;




protected function changeLogAt($url){if (NULL !== $url && !is("string", $url)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($url)." given");
$response=$this->connectionTo($url)->get();
if (HttpConstants::STATUS_OK !== $response->getStatusCode()) {
throw new IllegalStateException('Cannot find changelog @ '.$url.': '.$response->toString());};


$log=new ChangeLog();




































$reader=new TextReader($response->getInputStream(),'utf-8');$··e= NULL; try {$separator='Version %[0-9?.], released %[0-9?-]';$version=$date=NULL;do {if (NULL === ($l=$reader->readLine())) {throw new IllegalStateException('ChangeLog malformed');};} while (2 !== sscanf($l,$separator,$version,$date));;do {$release=new Release();$release->setVersion('?.?.?' === $version?NULL:new Version($version));$release->setDate('????-??-??' === $date?Date::now():new Date($date));$reader->readLine();$rev=NULL;sscanf($reader->readLine(),'%*[^:]: %s',$rev);$release->setRevision($rev);$notes='';$version=$date=NULL;while (NULL !== ($l=$reader->readLine())) {if (2 === sscanf($l,$separator,$version,$date)) {break;};$notes.=$l.'
';};$release->setNotes(rtrim($notes,'
'));$log->addRelease($release);} while (NULL !== $l);;} catch (Exception $··e) {}try { $reader->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;return $log;}






protected function connectionTo($url){if (NULL !== $url && !is("string", $url)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($url)." given");
$conn=new HttpConnection($url);
$conn->setConnectTimeout(10.0);
return $conn;}





protected function zipballOf($url,Folder $tempDir){if (NULL !== $url && !is("string", $url)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($url)." given");
$headers=array();
do {
$this->out->write('===> ',$url,': ');
$response=$this->connectionTo($url,$headers)->get();
switch ($response->statusCode()) {
case HttpConstants::STATUS_OK: 


if ($disposition=$response->header('Content-Disposition')) {
$filename=NULL;
sscanf($disposition[0],'attachment; filename=%s',$filename);}else {

$filename=basename($url);};




$tmp=new File($tempDir,$filename);
if ($tmp->exists()&&$tmp->size() == this($response->header('Content-Length'),0)) {
$this->out->writeLine('Reusing local copy');}else {

$this->out->write('Downloading... ');


$xfr=new StreamTransfer($response->getInputStream(),$tmp->getOutputStream());$··e= NULL; try {$xfr->transferAll();} catch (Exception $··e) {}try { $xfr->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;
$this->out->writeLine('Done');};


return ZipFile::open($tmp->getInputStream());;

case HttpConstants::STATUS_FOUND: ;case HttpConstants::STATUS_SEE_OTHER: 
$this->out->writeLine('Redirect');
$headers['Referer']=$url;
$url=this($response->header('Location'),0);
continue;;

default: 
$this->out->writeLine('Error');
throw new IllegalStateException('Unexpected response for '.$url.': '.$response->toString());;};} while (

1);;}









protected function addIndex(FileOutputStream $ar,$arg,$name= NULL){if (NULL !== $arg && !is("var", $arg)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of var, ".xp::typeOf($arg)." given");if (NULL !== $name && !is("string", $name)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($name)." given");
if ($arg instanceof File) {
$f=$arg;
$size=$f->size();
isset($name)||$name=$f->getFilename();
$stream=$f->getInputStream();}else {

$size=strlen($arg);
$stream=new MemoryInputStream($arg);};


$ar->write(sprintf('--%d:%s:--
',$size,$name));while ($stream->available()) {
$ar->write($stream->read());};}








protected function addAll(Archive $archive,IOCollection $collection,$base){if (NULL !== $base && !is("string", $base)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($base)." given");




$iterator=new FilteredIOCollectionIterator($collection,new NegationOfFilter(new CollectionFilter()),TRUE);
$i=0;
while ($iterator->hasNext()) {
$uri=$iterator->next()->getURI();
$urn=strtr(preg_replace('#^('.preg_quote($base,'#').'|/)#','',$uri),DIRECTORY_SEPARATOR,'/');
$archive->add(new File($uri),$urn);
$i++%10||$this->out->write('.');};}







public function createXarRelease(array $build){
$version=new Version($build['version']);
$this->out->writeLine('===> ',$version);


$log=$this->changeLogAt(sprintf(XarRelease::CHANGELOG,$build['owner'],$build['repo'],$build['tag']));
if ($version->isReleaseCandidate()) {
$release=$log->getRelease(NULL);
$release->setVersion($version);
$release->setRevision($build['tag']);}else {

$release=$log->getRelease($version);};

$this->out->writeLine('---> ',$release);

$tempDir=new Folder('tmp');
$tempDir->exists()||$tempDir->create(493);


$zip=$this->zipballOf(sprintf(XarRelease::ZIPBALL,$build['owner'],$build['repo'],$build['tag']),$tempDir);


$this->out->write('---> Exporting [');
















$iter=$zip->iterator();$base=rtrim(create((cast($iter->next(), 'io.archive.zip.ZipDirEntry')))->getName().'/','/');while ($iter->hasNext()) {$entry=$iter->next();$relative=str_replace($base,'',$entry->getName());if ($entry->isDirectory()) {$folder=new Folder($tempDir,$relative);$folder->exists()||$folder->create(493);}else {$file=new File($tempDir,$relative);$tran=new StreamTransfer($entry->getInputStream(),$file->getOutputStream());$··e= NULL; try {$tran->transferAll();} catch (Exception $··e) {}try { $tran->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;};$this->out->write('.');};;
delete($zip);
$this->out->writeLine(']');


$targetDir=new Folder($tempDir,$version->getNumber());
$targetDir->exists()||$targetDir->create(493);


$coreSrc=new Folder($tempDir,'core','src','main','php');
$rtArchive=new Archive(new File($targetDir,'xp-rt-'.$version->getNumber().'.xar'));
$rtArchive->open(ARCHIVE_CREATE);
$rtArchive->addBytes('VERSION',$version->getNumber());
foreach (array('lang','xp','util','io','sapi','peer','rdbms','math','scriptlet','xml','remote','text','unittest','webservices','img','security','gui',) as $package) {
$this->out->write('     >> ',$coreSrc,' & ',$package,' [');
$this->addAll($rtArchive,new FileCollection(new Folder($coreSrc,$package)),$coreSrc->getURI());
$this->out->writeLine(']');};

$rtArchive->create();


$testSrc=new Folder($tempDir,'core','src','test','php');
$testRes=new Folder($tempDir,'core','src','test','resources');
$utArchive=new Archive(new File($targetDir,'xp-test-'.$version->getNumber().'.xar'));
$utArchive->open(ARCHIVE_CREATE);
foreach (array($testSrc,$testRes,) as $origin) {
$this->out->write('     >> ',$origin,' [');
$this->addAll($utArchive,new FileCollection($origin),$origin->getURI());
$this->out->writeLine(']');};

$utArchive->create();







$clIndex=create(new File($targetDir,'lib.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$clIndex);foreach (array($rtArchive,$utArchive,) as $entry) {$this->addIndex($clIndex,$entry->file,'lib/'.$entry->file->getFilename());};} catch (Exception $··e) {}try { $clIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;


$toolSrc=new Folder($tempDir,'core','tools');





$tsIndex=create(new File($targetDir,'tools.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$tsIndex);foreach (array('class.php','web.php','xar.php','lang.base.php',) as $tool) {$this->addIndex($tsIndex,new File($toolSrc,$tool),'tools/'.$tool);};} catch (Exception $··e) {}try { $tsIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;





$dpIndex=create(new File($targetDir,'depend.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$dpIndex);$this->addIndex($dpIndex,new File('res',$version->getSeries().'-depend.ini'),'depend.ini');} catch (Exception $··e) {}try { $dpIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;






$miIndex=create(new File($targetDir,'meta-inf.ar'))->getOutputStream();$··e= NULL; try {$this->out->writeLine('---> ',$tsIndex);$this->addIndex($miIndex,$release->toString(),'ChangeLog');$this->addIndex($miIndex,'.
lib/'.$rtArchive->file->getFileName(),'boot.pth');} catch (Exception $··e) {}try { $miIndex->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;}}xp::$registry['class.XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';xp::$registry['details.net.xp_framework.build.subscriber.XarRelease']= array (
  0 => 
  array (
    'tmp' => 
    array (
      5 => 
      array (
        'type' => 'io.Folder',
      ),
    ),
  ),
  1 => 
  array (
    'changeLogAt' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'net.xp_framework.build.ChangeLog',
      3 => 
      array (
      ),
      4 => 'Download ChangeLog from github',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'connectionTo' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'peer.http.HttpConnection',
      3 => 
      array (
      ),
      4 => 'Creates a HTTP connection. Uses a timeout of 10 seconds at github
is a bit slow in responding from while to while',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'zipballOf' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'io.Folder',
      ),
      2 => 'io.archive.zip.ZipArchiveReader',
      3 => 
      array (
      ),
      4 => 'Fetches a ZIP file',
      5 => 
      array (
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
    'createXarRelease' => 
    array (
      1 => 
      array (
        0 => '[:string]',
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

<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.archive.zip.ZipFile', 'io.archive.zip.ZipArchiveReader', 'io.streams.StreamTransfer', 'io.streams.MemoryInputStream', 'lang.archive.Archive', 'io.collections.IOCollection', 'io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.NegationOfFilter', 'io.collections.iterate.CollectionFilter', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.streams.StringWriter', 'peer.http.HttpResponse', 'io.collections.IOElement', 'io.archive.zip.ZipIterator', 'io.archive.zip.ZipDirEntry', 'io.archive.zip.ZipEntry');

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

private $tmp;





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









protected function addIndex(File $ar,$arg,$name= NULL){if (NULL !== $arg && !is("var", $arg)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of var, ".xp::typeOf($arg)." given");if (NULL !== $name && !is("string", $name)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($name)." given");
if ($arg instanceof File) {
$size=$arg->size();
isset($name)||$name=$arg->getFilename();
$stream=$arg->getInputStream();}else {

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
$this->out->writeLine('Handling ',$build);

$tempDir=new Folder('tmp');
$tempDir->exists()||$tempDir->create(493);





$zip=$this->zipballOf(sprintf(XarRelease::ZIPBALL,$build['owner'],$build['repo'],$build['tag']),$tempDir);


$this->out->write('---> Exporting [');
















$iter=$zip->iterator();$base=rtrim(create((cast($iter->next(), 'io.archive.zip.ZipDirEntry')))->getName().'/','/');while ($iter->hasNext()) {$entry=$iter->next();$relative=str_replace($base,'',$entry->getName());if ($entry->isDirectory()) {$folder=new Folder($tempDir,$relative);$folder->exists()||$folder->create(493);}else {$file=new File($tempDir,$relative);$tran=new StreamTransfer($entry->getInputStream(),$file->getOutputStream());$··e= NULL; try {$tran->transferAll();} catch (Exception $··e) {}try { $tran->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;};$this->out->write('.');};;
delete($zip);
$this->out->writeLine(']');


$targetDir=new Folder($tempDir,$build['version']);
$targetDir->exists()||$targetDir->create(493);
$coreSrc=new Folder($tempDir,'core','src','main','php');
$toolSrc=new Folder($tempDir,'core','tools');


$tsIndex=new File($targetDir,'tools.ar');
$this->out->writeLine('---> ',$tsIndex);
$tsIndex->open(FILE_MODE_WRITE);
foreach (array('class.php','web.php','xar.php','lang.base.php',) as $tool) {
$this->addIndex($tsIndex,new File($toolSrc,$tool),'tools/'.$tool);};

$tsIndex->close();


$rtArchive=new Archive(new File($targetDir,'xp-rt-'.$build['version'].'.xar'));
$rtArchive->open(ARCHIVE_CREATE);
$rtArchive->addBytes('VERSION',$build['version']);
foreach (array('lang','xp','util','io','sapi','peer','rdbms','math','scriptlet','xml','remote','text','unittest','webservices','img','security','gui',) as $package) {
$this->out->write('     >> ',$package,' [');
$this->addAll($rtArchive,new FileCollection(new Folder($coreSrc,$package)),$coreSrc->getURI());
$this->out->writeLine(']');};

$rtArchive->create();}}xp::$registry['class.XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';xp::$registry['details.net.xp_framework.build.subscriber.XarRelease']= array (
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
        0 => 'io.File',
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

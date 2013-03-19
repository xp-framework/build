<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.FileUtil', 'io.archive.zip.ZipFile', 'io.archive.zip.ZipArchiveReader', 'io.streams.StreamTransfer', 'io.streams.MemoryInputStream', 'io.streams.TextReader', 'lang.archive.Archive', 'io.collections.IOCollection', 'io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.NegationOfFilter', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.ExtensionEqualsFilter', 'net.xp_framework.build.Version', 'net.xp_framework.build.Release', 'net.xp_framework.build.ChangeLog', 'net.xp_framework.build.ChangeLogParser', 'util.Date', 'util.Properties', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.streams.StringWriter', 'peer.http.HttpResponse', 'io.archive.zip.ZipIterator', 'io.archive.zip.ZipDirEntry', 'io.archive.zip.ZipEntry');

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
;
;
;
;




 class FetchRepository extends net·xp_framework·build·subscriber·AbstractSubscriber{



const ZIPBALL='https://github.com/%s/%s/zipball/%s';
const CHANGELOG='https://raw.github.com/%s/%s/%s/core/ChangeLog';

private $target;




protected function origin(){
return 'trigger';}





protected function destination(){
return 'build';}






public function useCheckout(Properties $prop){
$this->target=new Folder($prop->readString('storage','folder','checkout'));
$this->target->exists()||$this->target->create(493);}






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








public function fetch(array $build){
$version=new Version($build['version']);
$this->out->writeLine('===> ',$version);


$response=$this->connectionTo(sprintf(FetchRepository::CHANGELOG,$build['owner'],$build['repo'],$build['tag']))->get();
if (HttpConstants::STATUS_OK !== $response->getStatusCode()) {
throw new IllegalStateException('Cannot find changelog: '.$response->toString());};

$log=create(new ChangeLogParser())->parse($response->getInputStream());
if ($version->isReleaseCandidate()) {
$release=$log->getRelease(NULL);
$release->setVersion($version);
$release->setRevision($build['tag']);}else {

$release=$log->getRelease($version);};


$targetDir=new Folder($this->target,$build['owner'],$build['repo'],$build['tag']);
$targetDir->exists()||$targetDir->create(493);


$zip=$this->zipballOf(sprintf(FetchRepository::ZIPBALL,$build['owner'],$build['repo'],$build['tag']),$targetDir);


$this->out->write('---> Exporting [');
















$iter=$zip->iterator();$base=rtrim(create((cast($iter->next(), 'io.archive.zip.ZipDirEntry')))->getName().'/','/');while ($iter->hasNext()) {$entry=$iter->next();$relative=str_replace($base,'',$entry->getName());if ($entry->isDirectory()) {$folder=new Folder($targetDir,$relative);$folder->exists()||$folder->create(493);}else {$file=new File($targetDir,$relative);$tran=new StreamTransfer($entry->getInputStream(),$file->getOutputStream());$··e= NULL; try {$tran->transferAll();} catch (Exception $··e) {}try { $tran->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;};$this->out->write('.');};;
$zip->close();
$this->out->writeLine(']');


return array('module' => 
$build['owner'].'/'.$build['repo'],'release' => 
$release,'checkout' => 
$targetDir->getURI(),);}}xp::$registry['class.FetchRepository']= 'net.xp_framework.build.subscriber.FetchRepository';xp::$registry['details.net.xp_framework.build.subscriber.FetchRepository']= array (
  0 => 
  array (
    'target' => 
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
      4 => 'React directly on the trigger',
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
      4 => 'Publishes final',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'useCheckout' => 
    array (
      1 => 
      array (
        0 => 'util.Properties',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Injects fetch configuration',
      5 => 
      array (
        'inject' => 
        array (
          'name' => 'fetch',
        ),
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
    'fetch' => 
    array (
      1 => 
      array (
        0 => '[:var]',
      ),
      2 => '[:var]',
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
    4 => 'Fetches repository and extracts locally',
  ),
);
?>

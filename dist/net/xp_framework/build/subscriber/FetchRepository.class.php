<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.FileUtil', 'io.archive.zip.ZipFile', 'io.archive.zip.ZipArchiveReader', 'io.streams.StreamTransfer', 'net.xp_framework.build.Version', 'net.xp_framework.build.Release', 'net.xp_framework.build.ChangeLog', 'net.xp_framework.build.BuildInstructions', 'util.Date', 'util.Properties', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.streams.StringWriter', 'peer.http.HttpResponse', 'io.archive.zip.ZipIterator', 'io.archive.zip.ZipDirEntry', 'io.archive.zip.ZipEntry', 'webservices.rest.RestFormat');

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

$targetDir=new Folder($this->target,$build['owner'],$build['repo'],$build['tag']);
$targetDir->exists()||$targetDir->create(493);


$zip=$this->zipballOf(sprintf(FetchRepository::ZIPBALL,$build['owner'],$build['repo'],$build['tag']),$targetDir);


$this->out->write('---> Exporting [');
$i=0;
















$iter=$zip->iterator();$base=rtrim(create((\cast($iter->next(), 'io.archive.zip.ZipDirEntry')))->getName().'/','/');while ($iter->hasNext()) {$entry=$iter->next();$relative=str_replace($base,'',$entry->getName());if ($entry->isDirectory()) {$folder=new Folder($targetDir,$relative);$folder->exists()||$folder->create(493);}else {$file=new File($targetDir,$relative);$tran=new StreamTransfer($entry->getInputStream(),$file->getOutputStream());$··e= NULL; try {$tran->transferAll();} catch (Exception $··e) {}try { $tran->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;};$i++%100||$this->out->write('.');};;
$zip->close();
$this->out->writeLine(']');


$f=new File($targetDir,'xpbuild.json');
if ($f->exists()) {
$instructions=\cast(RestFormat::$JSON->read($f->getInputStream(),XPClass::forName('net.xp_framework.build.BuildInstructions')), 'net.xp_framework.build.BuildInstructions');}else {

$instructions=\cast(BuildInstructions::$DEFAULT, 'net.xp_framework.build.BuildInstructions');};



try {
$log=$instructions->changeLogIn($targetDir);
if ($version->isReleaseCandidate()) {
$release=$log->getRelease(NULL);
$release->setVersion($version);
$release->setRevision($build['tag']);}else {

$release=$log->getRelease($version);};} catch(IllegalStateException $e) {


$this->err->writeLine('Cannot read ChangeLog, using defaults ~ ',$e);
$release=new Release();
$release->setVersion($version);
$release->setRevision($build['tag']);
$release->setDate(Date::now());};



return array('build' => 
$instructions,'vendor' => 
$build['owner'],'module' => 
$build['repo'],'release' => 
$release,'checkout' => 
$targetDir->getURI(),);}}xp::$cn['FetchRepository']= 'net.xp_framework.build.subscriber.FetchRepository';xp::$meta['net.xp_framework.build.subscriber.FetchRepository']= array (
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

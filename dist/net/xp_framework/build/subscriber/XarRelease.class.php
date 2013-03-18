<?php uses('peer.http.HttpConnection', 'peer.http.HttpConstants', 'io.Folder', 'io.File', 'io.archive.zip.ZipFile', 'io.archive.zip.ZipArchiveReader', 'io.streams.StreamTransfer', 'net.xp_framework.build.subscriber.AbstractSubscriber', 'io.streams.StringWriter', 'peer.http.HttpResponse');

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








public function createXarRelease(array $build){
$this->out->writeLine('Handling ',$build);

$tempDir=new Folder('tmp');
$tempDir->exists()||$tempDir->create(493);




$zip=$this->zipballOf(sprintf(XarRelease::ZIPBALL,$build['owner'],$build['repo'],$build['tag']),$tempDir);}}xp::$registry['class.XarRelease']= 'net.xp_framework.build.subscriber.XarRelease';xp::$registry['details.net.xp_framework.build.subscriber.XarRelease']= array (
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

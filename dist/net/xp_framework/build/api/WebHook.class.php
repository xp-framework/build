<?php uses('webservices.rest.srv.Response', 'webservices.rest.RestFormat', 'util.log.LogCategory', 'util.Properties', 'io.IOException', 'io.streams.MemoryInputStream', 'io.collections.FileCollection', 'org.codehaus.stomp.StompConnection', 'net.xp_framework.build.api.GitHubPayload', 'net.xp_framework.build.api.GitHubRepository', 'net.xp_framework.build.api.GitHubUserReference', 'io.collections.IOCollection');

;
;
;
;
;
;
;
;

;






 class WebHook extends Object{
private $cat;
private $queue;
private $storage;
private $destination;

private static $json;





public function setTrace(LogCategory $cat= NULL){
$this->cat=$cat;}






public function useMessageQueue(Properties $prop){
$this->queue=new StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destination=$prop->readString('destinations','trigger');}






public function useStorage(Properties $prop){
$this->storage=new FileCollection($prop->readString('storage','folder','releases'));}





public function __destruct(){
$this->queue->disconnect();}








public function githubTrigger($in){
try {
$payload=cast(RestFormat::$JSON->read(new MemoryInputStream($in),XPClass::forName('net.xp_framework.build.api.GitHubPayload')), 'net.xp_framework.build.api.GitHubPayload');} catch(FormatException $e) {

$this->cat&&$this->cat->warn('Malformed payload',$e);
return Response::error(400)->withPayload('Malformed payload: '.$e->compoundMessage());};



try {
if (!($vendor=$this->storage->findCollection($payload->repository->owner->name))) {
$this->cat&&$this->cat->info('New vendor',$payload->repository->owner);
$vendor=$this->storage->newCollection($payload->repository->owner->name);};


if (!($module=$vendor->findCollection($payload->repository->name))) {
$this->cat&&$this->cat->info('New module',$payload->repository);
$module=$vendor->newCollection($payload->repository->name);};


if (!($info=$module->findElement('module.json'))) {
$info=$module->newElement('module.json');};










$out=$info->getOutputStream();$out->write(WebHook::$json->serialize(array('vendor' => $payload->repository->owner->name,'module' => $payload->repository->name,'info' => $payload->repository->description,'link' => $payload->repository->url,)));$out->close();;} catch(IOException $e) {

$this->cat&&$this->cat->warn('Storage error, continuing anyways',$e);};



if ($payload->created&&($tag=$payload->getTag())) {
sscanf($tag,'r%[0-9A-Za-z.~]',$version);







$message=WebHook::$json->serialize(array('owner' => $payload->repository->owner->name,'repo' => $payload->repository->name,'tag' => $tag,'version' => $version,'user' => $payload->pusher->name,));
$this->cat&&$this->cat->info($this->destination,$message);
$this->queue->send($this->destination,$message,
array('content-type' => WebHook::$json->contentType(),));}else {


$this->cat&&$this->cat->debug('Ignore',$payload);};


return Response::created();}static function __static() {WebHook::$json=RestFormat::$JSON->serializer();}}xp::$registry['class.WebHook']= 'net.xp_framework.build.api.WebHook';xp::$registry['details.net.xp_framework.build.api.WebHook']= array (
  0 => 
  array (
    'cat' => 
    array (
      5 => 
      array (
        'type' => 'util.log.LogCategory',
      ),
    ),
    'queue' => 
    array (
      5 => 
      array (
        'type' => 'org.codehaus.stomp.StompConnection',
      ),
    ),
    'storage' => 
    array (
      5 => 
      array (
        'type' => 'io.collections.FileCollection',
      ),
    ),
    'destination' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'json' => 
    array (
      5 => 
      array (
        'type' => 'var',
      ),
    ),
  ),
  1 => 
  array (
    'setTrace' => 
    array (
      1 => 
      array (
        0 => 'util.log.LogCategory',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets a logger category for debugging',
      5 => 
      array (
        'inject' => 
        array (
          'name' => 'trace',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'useMessageQueue' => 
    array (
      1 => 
      array (
        0 => 'util.Properties',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Injects message queue configuration',
      5 => 
      array (
        'inject' => 
        array (
          'name' => 'mq',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'useStorage' => 
    array (
      1 => 
      array (
        0 => 'util.Properties',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Use configuration to inject release storage',
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
    '__destruct' => 
    array (
      1 => 
      array (
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Disconnects from queue',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'githubTrigger' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'webservices.rest.srv.Response',
      3 => 
      array (
      ),
      4 => 'GitHub passes a JSON string as value for the "payload" form variable',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'POST',
          'accepts' => 'application/x-www-form-urlencoded',
        ),
      ),
      6 => 
      array (
        '$in' => 
        array (
          'param' => 'payload',
        ),
      ),
    ),
  ),
  'class' => 
  array (
    5 => 
    array (
      'webservice' => 
      array (
        'path' => '/hook',
      ),
    ),
    4 => 'Web hook to capture tag creation',
  ),
);
?>

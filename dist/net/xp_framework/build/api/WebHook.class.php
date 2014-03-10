<?php namespace net\xp_framework\build\api;

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






class WebHook extends \lang\Object{
private $cat;
private $queue;
private $storage;
private $destination;

private static $json;





public function setTrace(\util\log\LogCategory $cat= NULL){
$this->cat=$cat;}






public function useMessageQueue(\util\Properties $prop){
$this->queue=new \org\codehaus\stomp\StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destination=$prop->readString('destinations','trigger');}






public function useStorage(\util\Properties $prop){
$this->storage=new \io\collections\FileCollection($prop->readString('storage','folder','releases'));}





public function __destruct(){
$this->queue->disconnect();}





private function create(\io\collections\IOElement $element,$permissions){
if (FALSE === chmod($element->getURI(),$permissions)) {
throw new \io\IOException('Cannot change permissions for '.$element->getURI().' to '.$permissions);};

return $element;}








public function githubTrigger($in){
try {
$payload=cast(\webservices\rest\RestFormat::$JSON->read(new \io\streams\MemoryInputStream($in),\lang\XPClass::forName('net.xp_framework.build.api.GitHubPayload')), 'net.xp_framework.build.api.GitHubPayload');} catch(\lang\FormatException $e) {

$this->cat&&$this->cat->warn('Malformed payload',$e);
return \webservices\rest\srv\Response::error(400)->withPayload('Malformed payload: '.$e->compoundMessage());};



try {
if (!($vendor=$this->storage->findCollection($payload->repository->owner->name))) {
$this->cat&&$this->cat->warn('Unrecognized vendor, ignoring',$payload->repository->owner);
return \webservices\rest\srv\Response::error(403)->withPayload('Not allowed here');};


if (!($module=$vendor->findCollection($payload->repository->name))) {
$this->cat&&$this->cat->info('New module',$payload->repository);
$module=$this->create($vendor->newCollection($payload->repository->name),511);};


if (!($info=$module->findElement('module.json'))) {
$info=$this->create($module->newElement('module.json'),438);};










$out=$info->getOutputStream();$out->write(\net\xp_framework\build\api\WebHook::$json->serialize(array('vendor' => $payload->repository->owner->name,'module' => $payload->repository->name,'info' => $payload->repository->description,'link' => $payload->repository->url,)));$out->close();;} catch(\io\IOException $e) {

$this->cat&&$this->cat->warn('Storage error, continuing anyways',$e);};



if ($payload->created&&($tag=$payload->getTag())) {
$version=NULL;
sscanf($tag,'r%[0-9A-Za-z.~]',$version);







$message=\net\xp_framework\build\api\WebHook::$json->serialize(array('owner' => $payload->repository->owner->name,'repo' => $payload->repository->name,'tag' => $tag,'version' => $version,'user' => $payload->pusher->name,));
$this->cat&&$this->cat->info($this->destination,$message);
$this->queue->send($this->destination,$message,
array('content-type' => \net\xp_framework\build\api\WebHook::$json->contentType(),));}else {


$this->cat&&$this->cat->debug('Ignore',$payload);};


return \webservices\rest\srv\Response::created();}static function __static() {\net\xp_framework\build\api\WebHook::$json=\webservices\rest\RestFormat::$JSON->serializer();}}\xp::$cn['net\xp_framework\build\api\WebHook']= 'net.xp_framework.build.api.WebHook';\xp::$meta['net.xp_framework.build.api.WebHook']= array(0 => array('cat' => array(5 => array('type' => 'util.log.LogCategory'), 4 => NULL, 6 => array()), 'queue' => array(5 => array('type' => 'org.codehaus.stomp.StompConnection'), 4 => NULL, 6 => array()), 'storage' => array(5 => array('type' => 'io.collections.FileCollection'), 4 => NULL, 6 => array()), 'destination' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'json' => array(5 => array('type' => 'webservices.rest.RestSerializer'), 4 => NULL, 6 => array())), 1 => array('setTrace' => array(1 => array(0 => 'util.log.LogCategory'), 2 => 'void', 3 => array(), 4 => 'Sets a logger category for debugging', 5 => array('inject' => array('name' => 'trace')), 6 => array()), 'useMessageQueue' => array(1 => array(0 => 'util.Properties'), 2 => 'void', 3 => array(), 4 => 'Injects message queue configuration', 5 => array('inject' => array('name' => 'mq')), 6 => array()), 'useStorage' => array(1 => array(0 => 'util.Properties'), 2 => 'void', 3 => array(), 4 => 'Use configuration to inject release storage', 5 => array('inject' => array('name' => 'xarrelease')), 6 => array()), '__destruct' => array(1 => array(), 2 => 'void', 3 => array(), 4 => 'Disconnects from queue', 5 => array(), 6 => array()), 'create' => array(1 => array(0 => 'io.collections.IOElement', 1 => 'int'), 2 => 'io.collections.IOElement', 3 => array(), 4 => 'Change permissions', 5 => array(), 6 => array()), 'githubTrigger' => array(1 => array(0 => 'string'), 2 => 'webservices.rest.srv.Response', 3 => array(), 4 => 'GitHub passes a JSON string as value for the "payload" form variable', 5 => array('webmethod' => array('verb' => 'POST', 'accepts' => 'application/x-www-form-urlencoded')), 6 => array('$in' => array('param' => 'payload')))), 'class' => array(4 => 'Web hook to capture tag creation', 5 => array('webservice' => array('path' => '/hook')), 6 => array()));new \import('net.xp_framework.build.api.GitHubPayload');
?>

<?php uses('webservices.rest.srv.Response', 'webservices.rest.RestFormat', 'util.log.LogCategory', 'util.Properties', 'io.streams.MemoryInputStream', 'org.codehaus.stomp.StompConnection', 'net.xp_framework.build.api.GitHubPayload', 'net.xp_framework.build.api.GitHubRepository', 'net.xp_framework.build.api.GitHubUserReference');

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
private $destination;





public function setTrace(LogCategory $cat= NULL){
$this->cat=$cat;}






public function useMessageQueue(Properties $prop){
$this->queue=new StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destination=$prop->readString('queue','destination');}


public function __destruct(){
$this->queue->disconnect();}








public function githubTrigger($in){
try {
$payload=cast(RestFormat::$JSON->read(new MemoryInputStream($in),XPClass::forName('net.xp_framework.build.api.GitHubPayload')), 'net.xp_framework.build.api.GitHubPayload');} catch(FormatException $e) {

return Response::error(400)->withPayload('Malformed payload: '.$e->compoundMessage());};



if ($payload->created&&($tag=$payload->getTag())) {
sscanf($tag,'r%[0-9.]',$version);






$message=RestFormat::$JSON->serializer()->serialize(array('owner' => $payload->repository->owner->name,'repo' => $payload->repository->name,'tag' => $tag,'version' => $version.'RC1','user' => $payload->pusher->name,));
$this->cat&&$this->cat->info($message);
$r=$this->queue->send($this->destination,$message);
$this->cat&&$this->cat->info($r);}else {

$this->cat&&$this->cat->debug('Ignore',$payload);};


return Response::created();}}xp::$registry['class.WebHook']= 'net.xp_framework.build.api.WebHook';xp::$registry['details.net.xp_framework.build.api.WebHook']= array (
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
    'destination' => 
    array (
      5 => 
      array (
        'type' => 'string',
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
    '__destruct' => 
    array (
      1 => 
      array (
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

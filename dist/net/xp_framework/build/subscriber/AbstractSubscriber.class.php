<?php uses('util.Properties', 'org.codehaus.stomp.StompConnection', 'io.streams.MemoryInputStream', 'webservices.rest.RestFormat', 'util.cmd.Command', 'io.streams.StringWriter', 'org.codehaus.stomp.frame.Frame', 'webservices.rest.RestSerializer');

;
;
;
;




$package= 'net.xp_framework.build.subscriber';abstract  class net·xp_framework·build·subscriber·AbstractSubscriber extends Command{
private $queue;
private $timeout;
private $origin;
private $destination;




protected abstract function origin();




protected abstract function destination();





public function useMessageQueue(Properties $prop){
$this->queue=new StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->origin=$prop->readString('destinations',$this->origin());
$this->destination=$prop->readString('destinations',$this->destination());}







protected function findHandler(){
foreach ($this->getClass()->getMethods() as $m) {
if ($m->hasAnnotation('handler')) {return $m;};};

return NULL;}






public function setTimeout($t= '1.0'){
$this->timeout=NULL === $t?NULL:(double)$t;}





public function run(){
$serializer=RestFormat::$JSON->serializer();


if (!($handler=$this->findHandler())) {
$this->err->writeLine('No handler method found in ',$this);
return 1;};



$this->queue->subscribe($this->origin);
$this->out->writeLinef(
'Subscribed to %s using %s timeout',
$this->origin,

NULL === $this->timeout?'no':$this->timeout.' second(s)');
while ($message=$this->queue->receive($this->timeout)) {
$this->err->writeLine('<<< ',$message);


if ('MESSAGE' !== $message->command()) {break;};


try {



$response=$handler->invoke($this,array(RestFormat::$JSON->read(new MemoryInputStream($message->getBody()),$handler->getParameter(0)->getType()),));
if (NULL === $response) {
$this->err->writeLine('+++');}else {

$this->err->writeLine('>>> ',$response);
$message=$serializer->serialize($response);
$this->queue->send($this->destination,$message,array('content-type' => 
$serializer->contentType(),));};} catch(TargetInvocationException $e) {



$this->err->writeLine('*** ',$e);};};


$this->out->writeLine('Finished listening');
return 0;}





public function __destruct(){
$this->queue->disconnect();}}xp::$cn['net·xp_framework·build·subscriber·AbstractSubscriber']= 'net.xp_framework.build.subscriber.AbstractSubscriber';xp::$meta['net.xp_framework.build.subscriber.AbstractSubscriber']= array (
  0 => 
  array (
    'queue' => 
    array (
      5 => 
      array (
        'type' => 'org.codehaus.stomp.StompConnection',
      ),
    ),
    'timeout' => 
    array (
      5 => 
      array (
        'type' => 'double',
      ),
    ),
    'origin' => 
    array (
      5 => 
      array (
        'type' => 'string',
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
    'origin' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Returns origin to use for messages',
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
      4 => 'Returns destination to use for replies',
      5 => 
      array (
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
    'findHandler' => 
    array (
      1 => 
      array (
      ),
      2 => 'lang.reflect.Method',
      3 => 
      array (
      ),
      4 => 'Find handler method',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'setTimeout' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets timeout. Defaults to 1 second, pass "-" for forever.',
      5 => 
      array (
        'arg' => NULL,
      ),
      6 => 
      array (
      ),
    ),
    'run' => 
    array (
      1 => 
      array (
      ),
      2 => 'int',
      3 => 
      array (
      ),
      4 => 'Listens',
      5 => 
      array (
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
      4 => 'Destructor. Closes connection to MQ',
      5 => 
      array (
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
    4 => 'Abstract base class for all subscribers',
  ),
);
?>

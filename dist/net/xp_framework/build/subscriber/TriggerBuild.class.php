<?php uses('util.Properties', 'org.codehaus.stomp.StompConnection', 'io.streams.MemoryInputStream', 'webservices.rest.RestFormat', 'util.cmd.Command', 'lang.System', 'io.streams.StringWriter');

;
;
;
;

;




 class TriggerBuild extends Command{
private $queue;
private $destination;
private $repository;
private $owner;
private $tag;
private $version;





public function useMessageQueue(Properties $prop){
$this->queue=new StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destination=$prop->readString('queue','destination');}






public function setRepo($repo){
sscanf($repo,'%[^/]/%s',$this->owner,$this->repository);}






public function setTag($tag){
if (1 !== sscanf($tag,'r%[0-9A-Za-z.~]',$this->version)) {
throw new IllegalArgumentException('Invalid tag '.$tag);};

$this->tag=$tag;}





public function run(){













$serializer=RestFormat::$JSON->serializer();$message=$serializer->serialize(array('owner' => $this->owner,'repo' => $this->repository,'tag' => $this->tag,'version' => $this->version,'user' => System::getProperty('user.name'),));$this->queue->send($this->destination,$message,array('content-type' => $serializer->contentType(),));$this->out->writeLine('Publish -> ',$this->destination,': ',$message);;
return 0;}





public function __destruct(){
$this->queue->disconnect();}}xp::$registry['class.TriggerBuild']= 'net.xp_framework.build.subscriber.TriggerBuild';xp::$registry['details.net.xp_framework.build.subscriber.TriggerBuild']= array (
  0 => 
  array (
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
    'repository' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'owner' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'tag' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'version' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
  ),
  1 => 
  array (
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
    'setRepo' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets repository - use "owner/name" syntax',
      5 => 
      array (
        'arg' => 
        array (
          'position' => 0,
        ),
      ),
      6 => 
      array (
      ),
    ),
    'setTag' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets tag - use "r[VERSION]" here.',
      5 => 
      array (
        'arg' => 
        array (
          'position' => 1,
        ),
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
    4 => 'Trigger a build',
  ),
);
?>

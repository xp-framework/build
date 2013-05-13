<?php uses('util.Properties', 'org.codehaus.stomp.StompConnection', 'webservices.rest.RestFormat', 'util.cmd.Command', 'io.Folder', 'webservices.rest.RestSerializer', 'webservices.rest.RestDeserializer', 'io.File', 'io.streams.StringWriter');

;
;
;

;
;




 class TriggerRelease extends Command{
private $queue;
private $destinations;
private $destination;
private $target;





public function useMessageQueue(Properties $prop){
$this->queue=new StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destinations=$prop->readSection('destinations');}






public function setTarget($dir){
$this->target=new Folder($dir);}






public function setQueue($name){
if (!isset($this->destinations[$name])) {
throw new IllegalArgumentException('No such destination "'.$name.'", have: '.xp::stringOf($this->destinations));};

$this->destination=$this->destinations[$name];}





public function run(){
$parts=explode(DIRECTORY_SEPARATOR,$this->target->getURI());
$release=substr($parts[sizeof($parts)-2],1);
$module=$parts[sizeof($parts)-3];
$vendor=$parts[sizeof($parts)-4];














$json=RestFormat::$JSON;$serializer=$json->serializer();$message=$serializer->serialize(array('build' => $json->deserializer()->deserialize(create(new File($this->target,'xpbuild.json'))->getInputStream()),'vendor' => $vendor,'module' => $module,'release' => $release,'checkout' => $this->target->getURI(),));$this->queue->send($this->destination,$message,array('content-type' => $serializer->contentType(),));$this->out->writeLine('Publish -> ',$this->destination,': ',$message);;
return 0;}





public function __destruct(){
$this->queue->disconnect();}}xp::$cn['TriggerRelease']= 'net.xp_framework.build.subscriber.TriggerRelease';xp::$meta['net.xp_framework.build.subscriber.TriggerRelease']= array (
  0 => 
  array (
    'queue' => 
    array (
      5 => 
      array (
        'type' => 'org.codehaus.stomp.StompConnection',
      ),
    ),
    'destinations' => 
    array (
      5 => 
      array (
        'type' => '[:string]',
      ),
    ),
    'destination' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
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
    'setTarget' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets target dir',
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
    'setQueue' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Sets which message queue to use',
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
    4 => 'Trigger a release build',
  ),
);
?>

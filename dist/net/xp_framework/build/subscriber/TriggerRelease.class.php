<?php namespace net\xp_framework\build\subscriber;

;
;
;

;
;




class TriggerRelease extends \util\cmd\Command{
private $queue;
private $destinations;
private $destination;
private $target;





public function useMessageQueue(\util\Properties $prop){
$this->queue=new \org\codehaus\stomp\StompConnection($prop->readString('endpoint','host'),$prop->readInteger('endpoint','port'));
$this->queue->connect($prop->readString('endpoint','user'),$prop->readString('endpoint','pass'));
$this->destinations=$prop->readSection('destinations');}






public function setTarget($dir){
$this->target=new \io\Folder($dir);}






public function setQueue($name){
if (!isset($this->destinations[$name])) {
throw new \lang\IllegalArgumentException('No such destination "'.$name.'", have: '.\xp::stringOf($this->destinations));};

$this->destination=$this->destinations[$name];}





public function run(){
$parts=explode(DIRECTORY_SEPARATOR,$this->target->getURI());
$release=substr($parts[sizeof($parts)-2],1);
$module=$parts[sizeof($parts)-3];
$vendor=$parts[sizeof($parts)-4];














$json=\webservices\rest\RestFormat::$JSON;$serializer=$json->serializer();$message=$serializer->serialize(array('build' => $json->deserializer()->deserialize(create(new \io\File($this->target,'xpbuild.json'))->getInputStream()),'vendor' => $vendor,'module' => $module,'release' => $release,'checkout' => $this->target->getURI(),));$this->queue->send($this->destination,$message,array('content-type' => $serializer->contentType(),));$this->out->writeLine('Publish -> ',$this->destination,': ',$message);;
return 0;}





public function __destruct(){
$this->queue->disconnect();}}\xp::$cn['net\xp_framework\build\subscriber\TriggerRelease']= 'net.xp_framework.build.subscriber.TriggerRelease';\xp::$meta['net.xp_framework.build.subscriber.TriggerRelease']= array(0 => array('queue' => array(5 => array('type' => 'org.codehaus.stomp.StompConnection'), 4 => NULL, 6 => array()), 'destinations' => array(5 => array('type' => '[:string]'), 4 => NULL, 6 => array()), 'destination' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'target' => array(5 => array('type' => 'io.Folder'), 4 => NULL, 6 => array())), 1 => array('useMessageQueue' => array(1 => array(0 => 'util.Properties'), 2 => 'void', 3 => array(), 4 => 'Injects message queue configuration', 5 => array('inject' => array('name' => 'mq')), 6 => array()), 'setTarget' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets target dir', 5 => array('arg' => array('position' => 0)), 6 => array()), 'setQueue' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets which message queue to use', 5 => array('arg' => array('position' => 1)), 6 => array()), 'run' => array(1 => array(), 2 => 'int', 3 => array(), 4 => 'Listens', 5 => array(), 6 => array()), '__destruct' => array(1 => array(), 2 => 'void', 3 => array(), 4 => 'Destructor. Closes connection to MQ', 5 => array(), 6 => array())), 'class' => array(4 => 'Trigger a release build', 5 => array(), 6 => array()));
?>

<?php namespace net\xp_framework\build\subscriber;

;
;
;
;
;

;




class TriggerBuild extends \util\cmd\Command{
private $queue= NULL;
private $destination;
private $repository;
private $owner;
private $tag;
private $version;

protected static $json;





public function useMessageQueue(\util\Properties $prop){
$this->queue=new \peer\stomp\Connection($prop->readString('endpoint','url'));
$this->queue->connect();
$this->destination=$prop->readString('destinations','trigger');}






public function setRepo($repo){
sscanf($repo,'%[^/]/%s',$this->owner,$this->repository);}






public function setVersion($version){
if (1 !== sscanf($version,'%[0-9A-Za-z.~]',$this->version)) {
throw new \lang\IllegalArgumentException('Invalid tag '.$version);};

$this->tag='r'.$this->version;}






public function setTag($tag= NULL){
if (NULL !== $tag) {$this->tag=$tag;};}





public function run(){











$dest=$this->queue->getDestination($this->destination);$message=\net\xp_framework\build\subscriber\TriggerBuild::$json->write(array('owner' => $this->owner,'repo' => $this->repository,'tag' => $this->tag,'version' => $this->version,'user' => \lang\System::getProperty('user.name'),));$dest->send(new \peer\stomp\SendableMessage($message,\net\xp_framework\build\subscriber\TriggerBuild::$json->contentType()));$this->out->writeLine('Publish -> ',$this->destination,': ',$message);;
return 0;}





public function __destruct(){
if (NULL !== $this->queue) {$this->queue->disconnect();};}static function __static() {\net\xp_framework\build\subscriber\TriggerBuild::$json=new \net\xp_framework\build\Json();}}\xp::$cn['net\xp_framework\build\subscriber\TriggerBuild']= 'net.xp_framework.build.subscriber.TriggerBuild';\xp::$meta['net.xp_framework.build.subscriber.TriggerBuild']= array(0 => array('queue' => array(5 => array('type' => 'peer.stomp.Connection'), 4 => NULL, 6 => array()), 'destination' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'repository' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'owner' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'tag' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'version' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'json' => array(5 => array('type' => 'net.xp_framework.build.Json'), 4 => NULL, 6 => array())), 1 => array('useMessageQueue' => array(1 => array(0 => 'util.Properties'), 2 => 'void', 3 => array(), 4 => 'Injects message queue configuration', 5 => array('inject' => array('name' => 'mq')), 6 => array()), 'setRepo' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets repository - use "owner/name" syntax', 5 => array('arg' => array('position' => 0)), 6 => array()), 'setVersion' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Sets version and tag', 5 => array('arg' => array('position' => 1)), 6 => array()), 'setTag' => array(1 => array(0 => 'string'), 2 => 'void', 3 => array(), 4 => 'Overrides tag', 5 => array('arg' => NULL), 6 => array()), 'run' => array(1 => array(), 2 => 'int', 3 => array(), 4 => 'Listens', 5 => array(), 6 => array()), '__destruct' => array(1 => array(), 2 => 'void', 3 => array(), 4 => 'Destructor. Closes connection to MQ', 5 => array(), 6 => array())), 'class' => array(4 => 'Trigger a build', 5 => array(), 6 => array()));
?>

<?php uses('io.collections.FileCollection', 'util.Properties');

;

$package= 'net.xp_framework.build.api'; class net�xp_framework�build�api�AbstractBuildInformation extends Object{
protected $storage;





public function useStorage(Properties $prop){
$this->storage=new FileCollection($prop->readString('storage','folder','releases'));}}xp::$registry['class.net�xp_framework�build�api�AbstractBuildInformation']= 'net.xp_framework.build.api.AbstractBuildInformation';xp::$registry['details.net.xp_framework.build.api.AbstractBuildInformation']= array (
  0 => 
  array (
    'storage' => 
    array (
      5 => 
      array (
        'type' => 'io.collections.FileCollection',
      ),
    ),
  ),
  1 => 
  array (
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
  ),
  'class' => 
  array (
    5 => 
    array (
    ),
    4 => NULL,
  ),
);
?>
<?php uses('util.Properties', 'util.NoSuchElementException', 'io.collections.FileCollection', 'webservices.rest.srv.RestContext', 'webservices.rest.srv.DefaultExceptionMapper');

;
;
;
;
;





$package= 'net.xp_framework.build.api'; class net·xp_framework·build·api·AbstractBuildInformation extends Object{
protected $storage;





public function useStorage(Properties $prop){
$this->storage=new FileCollection($prop->readString('storage','folder','releases'));}






public function mapException(RestContext $ctx){
$ctx->addExceptionMapping(XPClass::forName('util.NoSuchElementException'),new DefaultExceptionMapper(404));}}xp::$cn['net·xp_framework·build·api·AbstractBuildInformation']= 'net.xp_framework.build.api.AbstractBuildInformation';xp::$meta['net.xp_framework.build.api.AbstractBuildInformation']= array (
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
    'mapException' => 
    array (
      1 => 
      array (
        0 => 'webservices.rest.srv.RestContext',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Map the util.NoSuchElementException class to 404',
      5 => 
      array (
        'inject' => NULL,
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
    4 => 'Base class for all entity information resources. Holds a reference to 
the storage.',
  ),
);
?>

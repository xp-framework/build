<?php uses('io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.IOCollectionIterator', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.UriMatchesFilter', 'io.collections.iterate.AllOfFilter', 'webservices.rest.srv.Response', 'net.xp_framework.build.Version', 'net.xp_framework.build.api.AbstractBuildInformation', 'webservices.rest.RestFormat', 'webservices.rest.RestDeserializer', 'net.xp_framework.build.api.Filter', 'net.xp_framework.build.api.IsModule', 'io.collections.IOCollection');

;
;
;
;
;
;
;
;

;


 class ModuleInformation extends net·xp_framework·build·api·AbstractBuildInformation{
private static $json;








public function listModules($vendor,net·xp_framework·build·api·Filter $filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");
$target=$this->storage->getCollection($vendor);

if ($filter) {
$find=new AllOfFilter(array(new net·xp_framework·build·api·IsModule(),new UriMatchesFilter($filter->pattern),));}else {

$find=new net·xp_framework·build·api·IsModule();};


$modules=array();
foreach (new FilteredIOCollectionIterator($target,$find,TRUE) as $module) {
$modules[]=ModuleInformation::$json->deserialize($module->getInputStream(),Type::forName('[:var]'));};

return $modules;}









public function hasModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");
if ($this->storage->getCollection($vendor)->findCollection($module)) {
return Response::ok();}else {

return Response::notFound();};}










public function getModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module);

$module=ModuleInformation::$json->deserialize($target->getElement(net·xp_framework·build·api·IsModule::NAME)->getInputStream(),Type::forName('[:var]'));
$module['releases']=array();
foreach (new FilteredIOCollectionIterator($target,new CollectionFilter()) as $release) {
$version=new Version(basename($release->getURI()));




$module['releases'][$version->getNumber()]=array('series' => $version->getSeries(),'rc' => $version->isReleaseCandidate(),'published' => $release->createdAt(),);};

return $module;}static function __static() {ModuleInformation::$json=RestFormat::$JSON->deserializer();}}xp::$cn['ModuleInformation']= 'net.xp_framework.build.api.ModuleInformation';xp::$meta['net.xp_framework.build.api.ModuleInformation']= array (
  0 => 
  array (
    'json' => 
    array (
      5 => 
      array (
        'type' => 'webservices.rest.RestDeserializer',
      ),
    ),
  ),
  1 => 
  array (
    'listModules' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'net.xp_framework.build.api.Filter',
      ),
      2 => 'var[]',
      3 => 
      array (
      ),
      4 => 'Lists all modules',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'hasModule' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
      ),
      2 => 'webservices.rest.srv.Response',
      3 => 
      array (
      ),
      4 => 'Tests whether a specific module exists',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'HEAD',
          'path' => '/{module}',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'getModule' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
      ),
      2 => 'var',
      3 => 
      array (
      ),
      4 => 'Gets a single module',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/{module}',
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
      'webservice' => 
      array (
        'path' => '/vendors/{vendor}/modules',
      ),
    ),
    4 => NULL,
  ),
);
?>

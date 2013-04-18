<?php uses('io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.IOCollectionIterator', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.AllOfFilter', 'io.collections.iterate.NameMatchesFilter', 'webservices.rest.srv.Response', 'net.xp_framework.build.Version', 'net.xp_framework.build.api.AbstractBuildInformation', 'net.xp_framework.build.api.Filter', 'io.collections.IOCollection');

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








public function listModules($vendor,net·xp_framework·build·api·Filter $filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");
$target=$this->storage->getCollection($vendor);

if ($filter) {
$find=new AllOfFilter(array(new CollectionFilter(),new NameMatchesFilter($filter->pattern),));}else {

$find=new CollectionFilter();};


$modules=array();
foreach (new FilteredIOCollectionIterator($target,$find) as $module) {
$modules[]=array('vendor' => $vendor,'module' => basename($module->getURI()),);};

return $modules;}









public function hasModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");
if ($this->storage->getCollection($vendor)->findCollection($module)) {
return Response::ok();}else {

return Response::notFound();};}










public function getModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module);
foreach (new FilteredIOCollectionIterator($target,new CollectionFilter()) as $release) {



$releases[]=array('version' => new Version(basename($release->getURI())),'published' => $release->createdAt(),);};

return array('vendor' => $vendor,'modules' => $module,'releases' => $releases,);}}xp::$registry['class.ModuleInformation']= 'net.xp_framework.build.api.ModuleInformation';xp::$registry['details.net.xp_framework.build.api.ModuleInformation']= array (
  0 => 
  array (
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

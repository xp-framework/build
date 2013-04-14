<?php uses('io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.IOCollectionIterator', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.AllOfFilter', 'io.collections.iterate.IterationFilter', 'io.collections.iterate.NameMatchesFilter', 'webservices.rest.srv.Response', 'net.xp_framework.build.api.AbstractBuildInformation', 'net.xp_framework.build.api.Filter');

;
;
;
;
;
;
;
;

;


 class VendorInformation extends net·xp_framework·build·api·AbstractBuildInformation{









public function vendorExists($vendor){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");
if ($this->storage->findCollection($vendor)) {
return Response::ok();}else {

return Response::notFound();};}










public function modulesOf($vendor,net·xp_framework·build·api·Filter $filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");
if ($filter) {



$find=new AllOfFilter(array(new CollectionFilter(),new NameMatchesFilter($filter->pattern),));}else {

$find=new CollectionFilter();};


$modules=array();
$target=$this->storage->getCollection($vendor);
foreach (new FilteredIOCollectionIterator($target,$find) as $module) {



$modules[]=array('vendor' => $vendor,'module' => basename($module->getURI()),);};

return $modules;}}xp::$registry['class.VendorInformation']= 'net.xp_framework.build.api.VendorInformation';xp::$registry['details.net.xp_framework.build.api.VendorInformation']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'vendorExists' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'webservices.rest.srv.Response',
      3 => 
      array (
      ),
      4 => 'Gets a specific release',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'HEAD',
          'path' => '/{vendor}',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'modulesOf' => 
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
      4 => 'Gets a list of all modules for a given vendor',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/{vendor}',
        ),
      ),
      6 => 
      array (
        '$filter' => 
        array (
          'param' => 'filter',
        ),
      ),
    ),
  ),
  'class' => 
  array (
    5 => 
    array (
      'webservice' => NULL,
    ),
    4 => NULL,
  ),
);
?>

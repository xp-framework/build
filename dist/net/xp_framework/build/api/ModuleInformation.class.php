<?php namespace net\xp_framework\build\api;

;
;
;
;
;
;
;
;

;






class ModuleInformation extends \net\xp_framework\build\api\AbstractBuildInformation{
private static $json;








public function listModules($vendor,\net\xp_framework\build\api\Filter $filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");
$target=$this->storage->getCollection($vendor);

if ($filter) {
$find=new \io\collections\iterate\AllOfFilter(array(new \net\xp_framework\build\api\IsModule(),new \io\collections\iterate\UriMatchesFilter($filter->pattern),));}else {

$find=new \net\xp_framework\build\api\IsModule();};


$modules=array();
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($target,$find,TRUE) as $module) {
$modules[]=\net\xp_framework\build\api\ModuleInformation::$json->deserialize($module->getInputStream(),\lang\Type::forName('[:var]'));};

return $modules;}









public function hasModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");
if ($this->storage->getCollection($vendor)->findCollection($module)) {
return \webservices\rest\srv\Response::ok();}else {

return \webservices\rest\srv\Response::notFound();};}










public function getModule($vendor,$module){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module);
$module=\net\xp_framework\build\api\ModuleInformation::$json->deserialize($target->getElement(\net\xp_framework\build\api\IsModule::NAME)->getInputStream(),\lang\Type::forName('[:var]'));
$module['releases']=array();
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($target,new \io\collections\iterate\CollectionFilter()) as $release) {
$version=new \net\xp_framework\build\Version(basename($release->getURI()));




$module['releases'][$version->getNumber()]=array('series' => $version->getSeries(),'rc' => $version->isReleaseCandidate(),'published' => $release->lastModified(),);};

return $module;}static function __static() {\net\xp_framework\build\api\ModuleInformation::$json=\webservices\rest\RestFormat::$JSON->deserializer();}}\xp::$cn['net\xp_framework\build\api\ModuleInformation']= 'net.xp_framework.build.api.ModuleInformation';\xp::$meta['net.xp_framework.build.api.ModuleInformation']= array(0 => array('json' => array(5 => array('type' => 'webservices.rest.RestDeserializer'), 4 => NULL, 6 => array())), 1 => array('listModules' => array(1 => array(0 => 'string', 1 => 'net.xp_framework.build.api.Filter'), 2 => 'var[]', 3 => array(), 4 => 'Lists all modules', 5 => array('webmethod' => array('verb' => 'GET')), 6 => array()), 'hasModule' => array(1 => array(0 => 'string', 1 => 'string'), 2 => 'webservices.rest.srv.Response', 3 => array(), 4 => 'Tests whether a specific module exists', 5 => array('webmethod' => array('verb' => 'HEAD', 'path' => '/{module}')), 6 => array()), 'getModule' => array(1 => array(0 => 'string', 1 => 'string'), 2 => 'var', 3 => array(), 4 => 'Gets a single module', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/{module}')), 6 => array())), 'class' => array(4 => 'The "modules" resource supports listing, testing and fetching 
information about modules for a given vendor.', 5 => array('webservice' => array('path' => '/vendors/{vendor}/modules')), 6 => array()));
?>

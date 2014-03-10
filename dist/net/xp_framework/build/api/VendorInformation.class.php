<?php namespace net\xp_framework\build\api;

;
;
;
;
;
;
;

;






class VendorInformation extends \net\xp_framework\build\api\AbstractBuildInformation{







public function listVendors(\net\xp_framework\build\api\Filter $filter= NULL){
if ($filter) {
$find=new \io\collections\iterate\AllOfFilter(array(new \io\collections\iterate\CollectionFilter(),new \io\collections\iterate\NameMatchesFilter($filter->pattern),));}else {

$find=new \io\collections\iterate\CollectionFilter();};


$vendors=array();
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($this->storage,$find) as $vendor) {
$vendors[]=array('vendor' => basename($vendor->getURI()),);};

return $vendors;}








public function hasVendor($vendor){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");
if ($this->storage->findCollection($vendor)) {
return \webservices\rest\srv\Response::ok();}else {

return \webservices\rest\srv\Response::notFound();};}









public function getVendor($vendor){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");
$modules=array();
$target=$this->storage->getCollection($vendor);
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($target,new \io\collections\iterate\CollectionFilter()) as $module) {
$modules[]=basename($module->getURI());};

return array('vendor' => $vendor,'modules' => $modules,);}}\xp::$cn['net\xp_framework\build\api\VendorInformation']= 'net.xp_framework.build.api.VendorInformation';\xp::$meta['net.xp_framework.build.api.VendorInformation']= array(0 => array(), 1 => array('listVendors' => array(1 => array(0 => 'net.xp_framework.build.api.Filter'), 2 => 'var[]', 3 => array(), 4 => 'Lists all vendors', 5 => array('webmethod' => array('verb' => 'GET')), 6 => array()), 'hasVendor' => array(1 => array(0 => 'string'), 2 => 'webservices.rest.srv.Response', 3 => array(), 4 => 'Tests whether a specific vendor exists', 5 => array('webmethod' => array('verb' => 'HEAD', 'path' => '/{vendor}')), 6 => array()), 'getVendor' => array(1 => array(0 => 'string'), 2 => 'var', 3 => array(), 4 => 'Gets a single vendor', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/{vendor}')), 6 => array())), 'class' => array(4 => 'The "vendors" resource supports listing, testing and fetching 
information about vendors.', 5 => array('webservice' => array('path' => '/vendors')), 6 => array()));
?>

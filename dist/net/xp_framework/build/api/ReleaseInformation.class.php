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
;
;
;
;
;

;
;
;






class ReleaseInformation extends \net\xp_framework\build\api\AbstractBuildInformation{




protected function checksumOf(\io\collections\IOElement $element){
$checksum=\security\checksum\SHA1::digest();




$in=$element->getInputStream();$··e= NULL; try {while ($in->available()) {$checksum->update($in->read());};} catch (\Exception$··e) {}try { $in->close(); } catch (\Exception $··i) {}if ($··e) throw $··e;;
return $checksum->digest();}










public function listReleases($vendor,$module,\net\xp_framework\build\api\Filter $filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module);

if ($filter) {
$find=new \io\collections\iterate\AllOfFilter(array(new \io\collections\iterate\CollectionFilter(),new \io\collections\iterate\NameMatchesFilter($filter->pattern),));}else {

$find=new \io\collections\iterate\CollectionFilter();};


$releases=array();
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($target,$find) as $release) {





$releases[]=array('vendor' => $vendor,'module' => $module,'version' => new \net\xp_framework\build\Version(basename($release->getURI())),'published' => $release->lastModified(),);};

return $releases;}










public function hasRelease($vendor,$module,$release){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".\xp::typeOf($release)." given");
if ($this->storage->getCollection($vendor)->getCollection($module)->findCollection($release)) {
return \webservices\rest\srv\Response::ok();}else {

return \webservices\rest\srv\Response::notFound();};}











public function getRelease($vendor,$module,$release){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".\xp::typeOf($release)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module)->findCollection($release);
if (!$target) {
throw new \lang\ElementNotFoundException('No such release '.$release.' for '.$vendor.'/'.$module);};



$files=array();
foreach (new \io\collections\iterate\IOCollectionIterator($target) as $file) {
$name=basename($file->getURI());





$files[]=array('link' => sprintf('/vendors/%s/modules/%s/releases/%s/%s',$vendor,$module,$release,$name),'name' => $name,'size' => $file->getSize(),'sha1' => $this->checksumOf($file),);};



return 


array('vendor' => $vendor,'module' => $module,'version' => new \net\xp_framework\build\Version($release),'published' => 
$target->lastModified(),'files' => 

$files,);}










public function downloadFile($vendor,$module,$release,$file){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".\xp::typeOf($release)." given");if (NULL !== $file && !is("string", $file)) throw new IllegalArgumentException("Argument 4 passed to ".__METHOD__." must be of string, ".\xp::typeOf($file)." given");





$target=$this->storage->getCollection($vendor)->getCollection($module)->getCollection($release)->findElement($file);
if (!$target) {
throw new \lang\ElementNotFoundException('No file '.$file.' in release '.$release.' for '.$vendor.'/'.$module);};


return \webservices\rest\srv\StreamingOutput::of($target);}}\xp::$cn['net\xp_framework\build\api\ReleaseInformation']= 'net.xp_framework.build.api.ReleaseInformation';\xp::$meta['net.xp_framework.build.api.ReleaseInformation']= array(0 => array(), 1 => array('checksumOf' => array(1 => array(0 => 'io.collections.IOElement'), 2 => 'string', 3 => array(), 4 => 'Calculates a checksum for the given file', 5 => array(), 6 => array()), 'listReleases' => array(1 => array(0 => 'string', 1 => 'string', 2 => 'net.xp_framework.build.api.Filter'), 2 => 'var[]', 3 => array(), 4 => 'Gets a list of all releases for a given vendor and module', 5 => array('webmethod' => array('verb' => 'GET')), 6 => array('$filter' => array('param' => 'filter'))), 'hasRelease' => array(1 => array(0 => 'string', 1 => 'string', 2 => 'string'), 2 => 'webservices.rest.srv.Response', 3 => array(), 4 => 'Gets a specific release', 5 => array('webmethod' => array('verb' => 'HEAD', 'path' => '/{release}')), 6 => array()), 'getRelease' => array(1 => array(0 => 'string', 1 => 'string', 2 => 'string'), 2 => 'var', 3 => array(), 4 => 'Gets a specific release', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/{release}')), 6 => array()), 'downloadFile' => array(1 => array(0 => 'string', 1 => 'string', 2 => 'string', 3 => 'string'), 2 => 'webservices.rest.srv.StreamingOutput', 3 => array(), 4 => 'Gets a specific release file', 5 => array('webmethod' => array('verb' => 'GET', 'path' => '/{release}/{file}')), 6 => array())), 'class' => array(4 => 'The "releases" resource supports listing, testing and fetching 
information about releases for a given vendor\'s module.', 5 => array('webservice' => array('path' => '/vendors/{vendor}/modules/{module}/releases')), 6 => array()));
?>

<?php uses('util.Properties', 'io.collections.FileCollection', 'io.collections.IOElement', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.IOCollectionIterator', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.AllOfFilter', 'io.collections.iterate.IterationFilter', 'io.collections.iterate.NameMatchesFilter', 'net.xp_framework.build.Version', 'webservices.rest.srv.Response', 'webservices.rest.RestFormat', 'webservices.rest.RestSerializer', 'security.checksum.SHA1', 'io.collections.IOCollection', 'io.streams.InputStream', 'security.checksum.MessageDigestImpl', 'lang.ElementNotFoundException', 'util.MimeType', 'io.streams.Streams');

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
;


 class ReleaseInformation extends Object{
private $storage;





public function useStorage(Properties $prop){
$this->storage=new FileCollection($prop->readString('storage','folder','releases'));}






protected function releasesOf($vendor,$module,IterationFilter $filter= NULL){
$releases=array();
$target=$this->storage->getCollection($vendor)->getCollection($module);
$find=new AllOfFilter(array_filter(array(new CollectionFilter(),$filter,)));
foreach (new FilteredIOCollectionIterator($target,$find) as $release) {





$releases[]=array('vendor' => $vendor,'module' => $module,'version' => new Version(basename($release->getURI())),'published' => $release->createdAt(),);};

return $releases;}





protected function checksumOf(IOElement $element){
$checksum=SHA1::digest();




$in=$element->getInputStream();$··e= NULL; try {while ($in->available()) {$checksum->update($in->read());};} catch (Exception $··e) {}try { $in->close(); } catch (Exception $··i) {}if ($··e) throw $··e;;
return $checksum->digest();}










public function allReleases($vendor,$module,$filter= NULL){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");if (NULL !== $filter && !is("string", $filter)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($filter)." given");
if ($filter) {
$restrict=new NameMatchesFilter('/^'.strtr(preg_quote($filter,'/'),array('\\*' => '.+',)).'$/');}else {

$restrict=NULL;};


return $this->releasesOf($vendor,$module,$restrict);}










public function hasRelease($vendor,$module,$release){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($release)." given");
if ($this->storage->getCollection($vendor)->getCollection($module)->findCollection($release)) {
return Response::ok();}else {

return Response::notFound();};}











public function getRelease($vendor,$module,$release){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($release)." given");
$target=$this->storage->getCollection($vendor)->getCollection($module)->findCollection($release);
if (!$target) {
throw new ElementNotFoundException('No such release '.$release.' for '.$vendor.'/'.$module);};



$files=array();
foreach (new IOCollectionIterator($target) as $file) {




$files[]=array('name' => basename($file->getURI()),'size' => $file->getSize(),'sha1' => $this->checksumOf($file),);};



return 


array('vendor' => $vendor,'module' => $module,'version' => new Version($release),'published' => 
$target->createdAt(),'files' => 
$files,);}











public function downloadFile($vendor,$module,$release,$file){if (NULL !== $vendor && !is("string", $vendor)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($vendor)." given");if (NULL !== $module && !is("string", $module)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".xp::typeOf($module)." given");if (NULL !== $release && !is("string", $release)) throw new IllegalArgumentException("Argument 3 passed to ".__METHOD__." must be of string, ".xp::typeOf($release)." given");if (NULL !== $file && !is("string", $file)) throw new IllegalArgumentException("Argument 4 passed to ".__METHOD__." must be of string, ".xp::typeOf($file)." given");





$target=$this->storage->getCollection($vendor)->getCollection($module)->getCollection($release)->findElement($file);
if (!$target) {
throw new ElementNotFoundException('No file '.$file.' in release '.$release.' for '.$vendor.'/'.$module);};





$mime=MimeType::getByFileName($target->getURI());








RestFormat::$UNKNOWN=new RestFormat(0,'UNKNOWN',new RestSerializer··514f301ddc03f(),NULL);
return 


Response::ok()->withHeader('Content-Type',$mime)->withHeader('Content-Length',$target->getSize())->withPayload($target->getInputStream());}}xp::$registry['class.ReleaseInformation']= 'net.xp_framework.build.api.ReleaseInformation';xp::$registry['details.net.xp_framework.build.api.ReleaseInformation']= array (
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
    'releasesOf' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
        2 => 'io.collections.iterate.IterationFilter',
      ),
      2 => 'var[]',
      3 => 
      array (
      ),
      4 => 'Gets a list of all releases for a given vendor and module, 
applying a given filter for finding them.',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'checksumOf' => 
    array (
      1 => 
      array (
        0 => 'io.collections.IOElement',
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Calculates a checksum for the given file',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'allReleases' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
        2 => 'string',
      ),
      2 => 'var[]',
      3 => 
      array (
      ),
      4 => 'Gets a list of all releases for a given vendor and module',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/{vendor}/{module}',
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
    'hasRelease' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
        2 => 'string',
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
          'path' => '/{vendor}/{module}/{release}',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'getRelease' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
        2 => 'string',
      ),
      2 => 'var',
      3 => 
      array (
      ),
      4 => 'Gets a specific release',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/{vendor}/{module}/{release}',
        ),
      ),
      6 => 
      array (
      ),
    ),
    'downloadFile' => 
    array (
      1 => 
      array (
        0 => 'string',
        1 => 'string',
        2 => 'string',
        3 => 'string',
      ),
      2 => 'webservices.rest.srv.Response',
      3 => 
      array (
      ),
      4 => 'Gets a specific release file',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
          'path' => '/{vendor}/{module}/{release}/{file}',
          'returns' => 'application/octet-stream',
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
      'webservice' => NULL,
    ),
    4 => NULL,
  ),
); class RestSerializer··514f301ddc03f extends RestSerializer{public function contentType(){return $mime;}public function serialize($payload){if (NULL !== $payload && !is("var", $payload)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of var, ".xp::typeOf($payload)." given");return Streams::readAll($payload->value);}}xp::$registry['class.RestSerializer··514f301ddc03f']= 'net.xp_framework.build.api.RestSerializer··514f301ddc03f';xp::$registry['details.net.xp_framework.build.api.RestSerializer··514f301ddc03f']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'contentType' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'serialize' => 
    array (
      1 => 
      array (
        0 => 'var',
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => NULL,
      5 => 
      array (
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

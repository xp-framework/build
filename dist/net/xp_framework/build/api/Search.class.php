<?php uses('io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.AllOfFilter', 'io.collections.iterate.UriMatchesFilter', 'text.regex.Pattern', 'net.xp_framework.build.api.AbstractBuildInformation', 'webservices.rest.RestFormat', 'net.xp_framework.build.api.IsModule');

;
;
;
;
;

;


 class Search extends net·xp_framework·build·api·AbstractBuildInformation{
private static $json;








public function forModules($query){



$find=new AllOfFilter(array(new net·xp_framework·build·api·IsModule(),new UriMatchesFilter(Pattern::compile($query,Pattern::CASE_INSENSITIVE)),));

$found=array();
foreach (new FilteredIOCollectionIterator($this->storage,$find,TRUE) as $module) {
$found[]=Search::$json->deserialize($module->getInputStream(),Type::forName('[:var]'));};

return $found;}static function __static() {Search::$json=RestFormat::$JSON->deserializer();}}xp::$cn['Search']= 'net.xp_framework.build.api.Search';xp::$meta['net.xp_framework.build.api.Search']= array (
  0 => 
  array (
    'json' => 
    array (
      5 => 
      array (
        'type' => 'var',
      ),
    ),
  ),
  1 => 
  array (
    'forModules' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'var[]',
      3 => 
      array (
      ),
      4 => 'Searches for modules',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'GET',
        ),
      ),
      6 => 
      array (
        '$query' => 
        array (
          'param' => 'q',
        ),
      ),
    ),
  ),
  'class' => 
  array (
    5 => 
    array (
      'webservice' => 
      array (
        'path' => '/search',
      ),
    ),
    4 => NULL,
  ),
);
?>

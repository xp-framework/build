<?php uses('io.collections.FileCollection', 'io.collections.iterate.FilteredIOCollectionIterator', 'io.collections.iterate.CollectionFilter', 'io.collections.iterate.AllOfFilter', 'io.collections.iterate.NameMatchesFilter', 'text.regex.Pattern', 'net.xp_framework.build.api.AbstractBuildInformation');

;
;
;
;
;
;

;


 class Search extends net·xp_framework·build·api·AbstractBuildInformation{








public function forModules($query){



$find=new AllOfFilter(array(new CollectionFilter(),new NameMatchesFilter(Pattern::compile($query,Pattern::CASE_INSENSITIVE)),));

$found=array();
foreach (new FilteredIOCollectionIterator($this->storage,new CollectionFilter()) as $vendor) {
foreach (new FilteredIOCollectionIterator($vendor,$find) as $module) {



$found[]=array('vendor' => basename($vendor->getURI()),'module' => basename($module->getURI()),);};};


return $found;}}xp::$registry['class.Search']= 'net.xp_framework.build.api.Search';xp::$registry['details.net.xp_framework.build.api.Search']= array (
  0 => 
  array (
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

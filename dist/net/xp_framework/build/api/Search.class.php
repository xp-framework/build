<?php namespace net\xp_framework\build\api;

;
;
;
;
;

;


class Search extends \net\xp_framework\build\api\AbstractBuildInformation{
private static $json;








public function forModules($query){



$find=new \io\collections\iterate\AllOfFilter(array(new \net\xp_framework\build\api\IsModule(),new \io\collections\iterate\UriMatchesFilter(\text\regex\Pattern::compile($query,\text\regex\Pattern::CASE_INSENSITIVE)),));

$found=array();
foreach (new \io\collections\iterate\FilteredIOCollectionIterator($this->storage,$find,TRUE) as $module) {
$found[]=\net\xp_framework\build\api\Search::$json->deserialize($module->getInputStream(),\lang\Type::forName('[:var]'));};

return $found;}static function __static() {\net\xp_framework\build\api\Search::$json=\webservices\rest\RestFormat::$JSON->deserializer();}}\xp::$cn['net\xp_framework\build\api\Search']= 'net.xp_framework.build.api.Search';\xp::$meta['net.xp_framework.build.api.Search']= array(0 => array('json' => array(5 => array('type' => 'webservices.rest.RestDeserializer'), 4 => NULL, 6 => array())), 1 => array('forModules' => array(1 => array(0 => 'string'), 2 => 'var[]', 3 => array(), 4 => 'Searches for modules', 5 => array('webmethod' => array('verb' => 'GET')), 6 => array('$query' => array('param' => 'q')))), 'class' => array(4 => NULL, 5 => array('webservice' => array('path' => '/search')), 6 => array()));
?>

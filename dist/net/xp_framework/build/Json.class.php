<?php namespace net\xp_framework\build;

;
;
;
;
;




class Json extends \lang\Object{
protected static $marshalling;
protected static $format;

public function contentType(){return 'text/json';}





public function read(\lang\Type $target,$in){if (NULL !== $in && !is("string", $in)) throw new IllegalArgumentException("Argument 2 passed to ".__METHOD__." must be of string, ".\xp::typeOf($in)." given");
return \net\xp_framework\build\Json::$marshalling->unmarshal($target,\net\xp_framework\build\Json::$format->read(new \io\streams\MemoryInputStream($in)));}





public function write($data){if (NULL !== $data && !is("var", $data)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of var, ".\xp::typeOf($data)." given");
$out=new \io\streams\MemoryOutputStream();
\net\xp_framework\build\Json::$format->write($out,new \webservices\rest\Payload(\net\xp_framework\build\Json::$marshalling->marshal($data)));
return $out->getBytes();}static function __static() {\net\xp_framework\build\Json::$marshalling=new \webservices\rest\RestMarshalling();\net\xp_framework\build\Json::$format=\webservices\rest\RestFormat::$JSON;}}\xp::$cn['net\xp_framework\build\Json']= 'net.xp_framework.build.Json';\xp::$meta['net.xp_framework.build.Json']= array(0 => array('marshalling' => array(5 => array('type' => 'webservices.rest.RestMarshalling'), 4 => NULL, 6 => array()), 'format' => array(5 => array('type' => 'webservices.rest.RestFormat'), 4 => NULL, 6 => array())), 1 => array('contentType' => array(1 => array(), 2 => 'string', 3 => array(), 4 => NULL, 5 => array(), 6 => array()), 'read' => array(1 => array(0 => 'lang.Type', 1 => 'string'), 2 => 'var', 3 => array(), 4 => 'Deserializes a given string and converts data to an instance of
the given type.', 5 => array(), 6 => array()), 'write' => array(1 => array(0 => 'var'), 2 => 'string', 3 => array(), 4 => 'Serialize given data to a string and return that string', 5 => array(), 6 => array())), 'class' => array(4 => 'Simple JSON I/O based on webservices.rest API', 5 => array(), 6 => array()));
?>

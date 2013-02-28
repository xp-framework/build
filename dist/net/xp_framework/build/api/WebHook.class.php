<?php uses('webservices.rest.srv.Response', 'webservices.rest.RestJsonDeserializer', 'io.streams.MemoryInputStream', 'net.xp_framework.build.api.GitHubPayload', 'webservices.json.JsonException', 'util.cmd.Console');

;
;


 class WebHook extends Object{







public function githubTrigger(MemoryInputStream $in){
try {
$payload=create(new RestJsonDeserializer())->deserialize($in,XPClass::forName('net.xp_framework.build.api.GitHubPayload'));} catch(JsonException $e) {

return Response::error(400)->withPayload('Malformed payload: '.$e->compoundMessage());};


Console::writeLine($payload);
return Response::created();}}xp::$registry['class.WebHook']= 'net.xp_framework.build.api.WebHook';xp::$registry['details.net.xp_framework.build.api.WebHook']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'githubTrigger' => 
    array (
      1 => 
      array (
        0 => 'io.streams.MemoryInputStream',
      ),
      2 => 'webservices.rest.srv.Response',
      3 => 
      array (
      ),
      4 => 'GitHub passes a JSON string as value for the "payload" form variable',
      5 => 
      array (
        'webmethod' => 
        array (
          'verb' => 'POST',
          'accepts' => 'application/x-www-form-urlencoded',
        ),
      ),
      6 => 
      array (
        '$in' => 
        array (
          'param' => 'payload',
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
        'path' => '/releases',
      ),
    ),
    4 => NULL,
  ),
);
?>

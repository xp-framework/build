<?php uses('webservices.rest.srv.Response', 'io.streams.MemoryInputStream', 'webservices.rest.RestJsonDeserializer', 'net.xp_framework.build.api.GitHubPayload', 'util.cmd.Console', 'net.xp_framework.build.api.GitHubUserReference');

;






 class WebHook extends Object{







public function githubTrigger(MemoryInputStream $in){
try {
$payload=cast(create(new RestJsonDeserializer())->deserialize($in,XPClass::forName('net.xp_framework.build.api.GitHubPayload')), 'net.xp_framework.build.api.GitHubPayload');} catch(FormatException $e) {

return Response::error(400)->withPayload('Malformed payload: '.$e->compoundMessage());};



if ($payload->created&&($tag=$payload->getTag())) {
Console::writeLine('Creating release ',$tag,', started by ',$payload->pusher->name);
Console::writeLine('-> ',$payload);}else {

Console::writeLine('Ignore ',$payload);};


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
        'path' => '/hook',
      ),
    ),
    4 => 'Web hook to capture tag creation',
  ),
);
?>

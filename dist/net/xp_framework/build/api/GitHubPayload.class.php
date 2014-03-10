<?php namespace net\xp_framework\build\api;

;






class GitHubPayload extends \lang\Object{
private static $tag;

public $pusher;
public $before;
public $after;
public $repository;
public $compare;
public $ref;
public $forced;
public $deleted;
public $created;
public $commits;
public $head_commit;





public function isTag(){
return \net\xp_framework\build\api\GitHubPayload::$tag->matches($this->ref);}






public function getTag(){
$m=\net\xp_framework\build\api\GitHubPayload::$tag->match($this->ref);
return $m->length()?this($m->group(0),1):NULL;}






private static function sha($self){if (NULL !== $self && !is("string", $self)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".\xp::typeOf($self)." given");
return substr($self,0,7);}






public function toString(){
return 





$this->getClassName().'('.\net\xp_framework\build\api\GitHubPayload::sha($this->before).'..'.\net\xp_framework\build\api\GitHubPayload::sha($this->after).' -> '.$this->ref.' by '.$this->pusher->name.') {
'.'  [created]    '.($this->created?'yes':'no').'
'.'  [deleted]    '.($this->deleted?'yes':'no').'
'.'  [forced]     '.($this->forced?'yes':'no').'
'.'  [commits]    '.\xp::stringOf($this->commits,'  ').'
'.'  [repository] '.\xp::stringOf($this->repository,'  ').'
'.'}';}static function __static() {\net\xp_framework\build\api\GitHubPayload::$tag=new \text\regex\Pattern('refs/tags/(.+)');}static function __import($scope) {\xp::$ext[$scope]['\string']= 'net\xp_framework\build\api\GitHubPayload';}}\xp::$cn['net\xp_framework\build\api\GitHubPayload']= 'net.xp_framework.build.api.GitHubPayload';\xp::$meta['net.xp_framework.build.api.GitHubPayload']= array(0 => array('tag' => array(5 => array('type' => 'text.regex.Pattern'), 4 => NULL, 6 => array()), 'pusher' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubUserReference'), 4 => NULL, 6 => array()), 'before' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'after' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'repository' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubRepository'), 4 => NULL, 6 => array()), 'compare' => array(5 => array('type' => 'net.xp_framework.build.api.Link'), 4 => NULL, 6 => array()), 'ref' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'forced' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'deleted' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'created' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'commits' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubCommit[]'), 4 => NULL, 6 => array()), 'head_commit' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubCommit'), 4 => NULL, 6 => array())), 1 => array('isTag' => array(1 => array(), 2 => 'bool', 3 => array(), 4 => 'Returns whether a tag is referenced', 5 => array(), 6 => array()), 'getTag' => array(1 => array(), 2 => 'bool', 3 => array(), 4 => 'Gets tag. Returns NULL if no tag exists', 5 => array(), 6 => array()), 'sha' => array(1 => array(0 => 'string'), 2 => 'string', 3 => array(), 4 => 'Creates short SHA display', 5 => array(), 6 => array()), 'toString' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Creates a string representation', 5 => array(), 6 => array())), 'class' => array(4 => 'Represents the GitHub Webhook trigger payload', 5 => array(), 6 => array()));
?>

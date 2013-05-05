<?php uses('text.regex.Pattern', 'net.xp_framework.build.api.GitHubUserReference', 'net.xp_framework.build.api.GitHubRepository', 'net.xp_framework.build.api.Link', 'net.xp_framework.build.api.GitHubCommit', 'text.regex.MatchResult');

;






 class GitHubPayload extends Object{
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
return GitHubPayload::$tag->matches($this->ref);}






public function getTag(){
$m=GitHubPayload::$tag->match($this->ref);
return $m->length()?this($m->group(0),1):NULL;}






private static function sha($self){if (NULL !== $self && !is("string", $self)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of string, ".xp::typeOf($self)." given");
return substr($self,0,7);}






public function toString(){
return 





$this->getClassName().'('.GitHubPayload::sha($this->before).'..'.GitHubPayload::sha($this->after).' -> '.$this->ref.' by '.$this->pusher->name.') {
'.'  [created]    '.($this->created?'yes':'no').'
'.'  [deleted]    '.($this->deleted?'yes':'no').'
'.'  [forced]     '.($this->forced?'yes':'no').'
'.'  [commits]    '.xp::stringOf($this->commits,'  ').'
'.'  [repository] '.xp::stringOf($this->repository,'  ').'
'.'}';}static function __static() {GitHubPayload::$tag=new Pattern('refs/tags/(.+)');}static function __import($scope) {xp::$ext[$scope]["string"]= "GitHubPayload";}}xp::$cn['GitHubPayload']= 'net.xp_framework.build.api.GitHubPayload';xp::$meta['net.xp_framework.build.api.GitHubPayload']= array (
  0 => 
  array (
    'tag' => 
    array (
      5 => 
      array (
        'type' => 'text.regex.Pattern',
      ),
    ),
    'pusher' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubUserReference',
      ),
    ),
    'before' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'after' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'repository' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubRepository',
      ),
    ),
    'compare' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.Link',
      ),
    ),
    'ref' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'forced' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'deleted' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'created' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'commits' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubCommit[]',
      ),
    ),
    'head_commit' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubCommit',
      ),
    ),
  ),
  1 => 
  array (
    'isTag' => 
    array (
      1 => 
      array (
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Returns whether a tag is referenced',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getTag' => 
    array (
      1 => 
      array (
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Gets tag. Returns NULL if no tag exists',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'sha' => 
    array (
      1 => 
      array (
        0 => 'string',
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Creates short SHA display',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'toString' => 
    array (
      1 => 
      array (
      ),
      2 => 'string',
      3 => 
      array (
      ),
      4 => 'Creates a string representation',
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
    4 => 'Represents the GitHub Webhook trigger payload',
  ),
);
?>

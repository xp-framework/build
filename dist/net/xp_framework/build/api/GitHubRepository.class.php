<?php uses('util.Date', 'peer.URL', 'net.xp_framework.build.api.GitHubUserReference');





 class GitHubRepository extends Object{
public $name;
public $master_branch;
public $created_at;
public $has_wiki;
public $size;
public $private;
public $watchers;
public $fork;
public $url;
public $id;
public $has_downloads;
public $open_issues;
public $has_issues;
public $homepage;
public $forks;
public $stargazers;
public $description;
public $owner;





public function toString(){
return 




$this->getClassName().'<'.$this->name.' @ '.$this->master_branch.'>'.'{
'.'  "'.$this->description.'"'.'
'.'  [owner]    '.$this->owner->name.'
'.'  [size]     '.$this->size.'
'.'  [created]  '.xp::stringOf($this->created_at).'
'.'}';}}xp::$cn['GitHubRepository']= 'net.xp_framework.build.api.GitHubRepository';xp::$meta['net.xp_framework.build.api.GitHubRepository']= array (
  0 => 
  array (
    'name' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'master_branch' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'created_at' => 
    array (
      5 => 
      array (
        'type' => 'util.Date',
      ),
    ),
    'has_wiki' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'size' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'private' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'watchers' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'fork' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'url' => 
    array (
      5 => 
      array (
        'type' => 'peer.URL',
      ),
    ),
    'id' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'has_downloads' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'open_issues' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'has_issues' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'homepage' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'forks' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'stargazers' => 
    array (
      5 => 
      array (
        'type' => 'int',
      ),
    ),
    'description' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'owner' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubUserReference',
      ),
    ),
  ),
  1 => 
  array (
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
    4 => 'Represents a GitHub repository with a bit of aggregated meta data.',
  ),
);
?>

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
public $descriptons;
public $owner;}xp::$registry['class.GitHubRepository']= 'net.xp_framework.build.api.GitHubRepository';xp::$registry['details.net.xp_framework.build.api.GitHubRepository']= array (
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
    'descriptons' => 
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

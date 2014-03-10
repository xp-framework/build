<?php namespace net\xp_framework\build\api;





class GitHubRepository extends \lang\Object{
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
'.'  [url]      '.$this->url->toString().'
'.'  [owner]    '.$this->owner->name.'
'.'  [size]     '.$this->size.'
'.'  [created]  '.\xp::stringOf($this->created_at).'
'.'}';}}\xp::$cn['net\xp_framework\build\api\GitHubRepository']= 'net.xp_framework.build.api.GitHubRepository';\xp::$meta['net.xp_framework.build.api.GitHubRepository']= array(0 => array('name' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'master_branch' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'created_at' => array(5 => array('type' => 'util.Date'), 4 => NULL, 6 => array()), 'has_wiki' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'size' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'private' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'watchers' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'fork' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'url' => array(5 => array('type' => 'net.xp_framework.build.api.Link'), 4 => NULL, 6 => array()), 'id' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'has_downloads' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'open_issues' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'has_issues' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'homepage' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'forks' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'stargazers' => array(5 => array('type' => 'int'), 4 => NULL, 6 => array()), 'description' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'owner' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubUserReference'), 4 => NULL, 6 => array())), 1 => array('toString' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Creates a string representation', 5 => array(), 6 => array())), 'class' => array(4 => 'Represents a GitHub repository with a bit of aggregated meta data.', 5 => array(), 6 => array()));
?>

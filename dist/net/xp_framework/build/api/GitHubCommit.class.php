<?php namespace net\xp_framework\build\api;

;





class GitHubCommit extends \lang\Object{
public $id;
public $url;
public $distinct;
public $added;
public $modified;
public $removed;
public $timestamp;
public $author;
public $committer;
public $message;





public function toString(){
return 





$this->getClassName().'<'.$this->id.' @ '.$this->timestamp->toString().' by '.$this->committer->username.'>{
'.'  "'.$this->message.'"'.'
'.'  [url]      '.$this->url->toString().'
'.'  [added]    '.implode(', ',$this->added).'
'.'  [modified] '.implode(', ',$this->modified).'
'.'  [removed]  '.implode(', ',$this->removed).'
'.'}';}}\xp::$cn['net\xp_framework\build\api\GitHubCommit']= 'net.xp_framework.build.api.GitHubCommit';\xp::$meta['net.xp_framework.build.api.GitHubCommit']= array(0 => array('id' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array()), 'url' => array(5 => array('type' => 'net.xp_framework.build.api.Link'), 4 => NULL, 6 => array()), 'distinct' => array(5 => array('type' => 'bool'), 4 => NULL, 6 => array()), 'added' => array(5 => array('type' => 'string[]'), 4 => NULL, 6 => array()), 'modified' => array(5 => array('type' => 'string[]'), 4 => NULL, 6 => array()), 'removed' => array(5 => array('type' => 'string[]'), 4 => NULL, 6 => array()), 'timestamp' => array(5 => array('type' => 'util.Date'), 4 => NULL, 6 => array()), 'author' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubUserReference'), 4 => NULL, 6 => array()), 'committer' => array(5 => array('type' => 'net.xp_framework.build.api.GitHubUserReference'), 4 => NULL, 6 => array()), 'message' => array(5 => array('type' => 'string'), 4 => NULL, 6 => array())), 1 => array('toString' => array(1 => array(), 2 => 'string', 3 => array(), 4 => 'Creates a string representation', 5 => array(), 6 => array())), 'class' => array(4 => 'Represents a GitHub commit.', 5 => array(), 6 => array()));
?>

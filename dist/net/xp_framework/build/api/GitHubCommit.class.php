<?php uses('peer.URL', 'util.Date', 'net.xp_framework.build.api.GitHubUserReference');

;





 class GitHubCommit extends Object{
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
'.' "'.$this->message.'"'.'
'.' [added]    '.implode(', ',$this->added).'
'.' [modified] '.implode(', ',$this->modified).'
'.' [removed]  '.implode(', ',$this->removed).'
'.'}';}}xp::$registry['class.GitHubCommit']= 'net.xp_framework.build.api.GitHubCommit';xp::$registry['details.net.xp_framework.build.api.GitHubCommit']= array (
  0 => 
  array (
    'id' => 
    array (
      5 => 
      array (
        'type' => 'string',
      ),
    ),
    'url' => 
    array (
      5 => 
      array (
        'type' => 'peer.URL',
      ),
    ),
    'distinct' => 
    array (
      5 => 
      array (
        'type' => 'bool',
      ),
    ),
    'added' => 
    array (
      5 => 
      array (
        'type' => 'string[]',
      ),
    ),
    'modified' => 
    array (
      5 => 
      array (
        'type' => 'string[]',
      ),
    ),
    'removed' => 
    array (
      5 => 
      array (
        'type' => 'string[]',
      ),
    ),
    'timestamp' => 
    array (
      5 => 
      array (
        'type' => 'util.Date',
      ),
    ),
    'author' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubUserReference',
      ),
    ),
    'committer' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.api.GitHubUserReference',
      ),
    ),
    'message' => 
    array (
      5 => 
      array (
        'type' => 'string',
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
    4 => 'Represents a GitHub commit.',
  ),
);
?>

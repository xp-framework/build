<?php uses('net.xp_framework.build.Release', 'net.xp_framework.build.Version', 'lang.ElementNotFoundException');




 class ChangeLog extends Object{
protected $releases= array (
);



public function addRelease(Release $release){
$this->releases[]=$release;
return $release;}





public function findRelease(Version $version= NULL){
foreach ($this->releases as $release) {
$cmp=$release->getVersion();
if (


(NULL === $cmp&&NULL === $version)||(NULL !== $cmp&&$cmp->equals($version))) {return $release;};};

return NULL;}





public function getRelease(Version $version= NULL){
if (NULL === ($release=$this->findRelease($version))) {
throw new ElementNotFoundException('No release with version '.xp::stringOf($version));};

return $release;}}xp::$registry['class.ChangeLog']= 'net.xp_framework.build.ChangeLog';xp::$registry['details.net.xp_framework.build.ChangeLog']= array (
  0 => 
  array (
    'releases' => 
    array (
      5 => 
      array (
        'type' => 'net.xp_framework.build.Release[]',
      ),
    ),
  ),
  1 => 
  array (
    'addRelease' => 
    array (
      1 => 
      array (
        0 => 'net.xp_framework.build.Release',
      ),
      2 => 'net.xp_framework.build.Release',
      3 => 
      array (
      ),
      4 => 'Adds a release',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'findRelease' => 
    array (
      1 => 
      array (
        0 => 'net.xp_framework.build.Version',
      ),
      2 => 'net.xp_framework.build.Release',
      3 => 
      array (
      ),
      4 => 'Finds a release with a specific version',
      5 => 
      array (
      ),
      6 => 
      array (
      ),
    ),
    'getRelease' => 
    array (
      1 => 
      array (
        0 => 'net.xp_framework.build.Version',
      ),
      2 => 'net.xp_framework.build.Release',
      3 => 
      array (
      ),
      4 => 'Finds a release with a specific version',
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
    4 => 'Represents the changelog',
  ),
);
?>

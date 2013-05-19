<?php uses('lang.ElementNotFoundException', 'net.xp_framework.build.Release', 'net.xp_framework.build.Version', 'util.Objects');

;




 class ChangeLog extends Object{
protected $releases= array (
);



public function addRelease(Release $release){
$this->releases[]=$release;
return $release;}





public function withRelease(Release $release){
$this->addRelease($release);
return $this;}





public function findRelease(Version $version= NULL){
foreach ($this->releases as $release) {
$cmp=$release->getVersion();
if (


(NULL === $cmp&&NULL === $version)||(NULL !== $cmp&&$cmp->equals($version))) {return $release;};};

return NULL;}





public function getRelease(Version $version= NULL){
if (NULL === ($release=$this->findRelease($version))) {
throw new ElementNotFoundException('No release with version '.xp::stringOf($version));};

return $release;}





public function equals($cmp){if (NULL !== $cmp && !is("var", $cmp)) throw new IllegalArgumentException("Argument 1 passed to ".__METHOD__." must be of var, ".xp::typeOf($cmp)." given");
return $cmp instanceof ChangeLog&&Objects::equal($this->releases,$cmp->releases);}






public function toString(){
return $this->getClassName().'(releases= '.xp::stringOf($this->releases).')';}}xp::$cn['ChangeLog']= 'net.xp_framework.build.ChangeLog';xp::$meta['net.xp_framework.build.ChangeLog']= array (
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
    'withRelease' => 
    array (
      1 => 
      array (
        0 => 'net.xp_framework.build.Release',
      ),
      2 => 'net.xp_framework.build.ChangeLog',
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
    'equals' => 
    array (
      1 => 
      array (
        0 => 'var',
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Returns whether another object is equal to this release',
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
      4 => 'Returns a string representation',
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

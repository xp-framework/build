<?php uses('io.collections.iterate.IterationFilter', 'io.collections.IOElement');

;
;

;




$package= 'net.xp_framework.build.api'; class net·xp_framework·build·api·IsModule extends Object implements IterationFilter{




public function accept($e){
return 'module.json' === basename($e->getURI());}}xp::$registry['class.net·xp_framework·build·api·IsModule']= 'net.xp_framework.build.api.IsModule';xp::$registry['details.net.xp_framework.build.api.IsModule']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'accept' => 
    array (
      1 => 
      array (
        0 => 'io.collections.IOElement',
      ),
      2 => 'bool',
      3 => 
      array (
      ),
      4 => 'Returns whether the given IOElement applies',
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
    4 => 'Searches for modules',
  ),
);
?>

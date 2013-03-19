<?php uses('lang.archive.Archive', 'io.Folder', 'net.xp_framework.build.subscriber.XarReleaseFinalizer');

;
;





 class DefaultFinalizer extends Object implements XarReleaseFinalizer{




public function finalize(array $build,array $archives,Folder $targetDir){
foreach ($archives as $archive) {
$archive->file->move($targetDir);};}}xp::$registry['class.DefaultFinalizer']= 'net.xp_framework.build.subscriber.DefaultFinalizer';xp::$registry['details.net.xp_framework.build.subscriber.DefaultFinalizer']= array (
  0 => 
  array (
  ),
  1 => 
  array (
    'finalize' => 
    array (
      1 => 
      array (
        0 => '[:var]',
        1 => '[:lang.archive.Archive]',
        2 => 'io.Folder',
      ),
      2 => 'void',
      3 => 
      array (
      ),
      4 => 'Finalize',
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
    4 => 'The default finalizer just moves the created libraries to the
target directory',
  ),
);
?>

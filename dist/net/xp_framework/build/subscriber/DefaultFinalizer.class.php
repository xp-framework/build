<?php namespace net\xp_framework\build\subscriber;

;
;
;
;





class DefaultFinalizer extends \lang\Object implements \net\xp_framework\build\subscriber\XarReleaseFinalizer{




public function finalize(array $build,array $archives,\io\Folder $targetDir){
foreach ($archives as $archive) {
$archive->file->move($targetDir);};

\io\FileUtil::setContents(new \io\File($targetDir,'ChangeLog'),$build['release']['notes'].'
');}}\xp::$cn['net\xp_framework\build\subscriber\DefaultFinalizer']= 'net.xp_framework.build.subscriber.DefaultFinalizer';\xp::$meta['net.xp_framework.build.subscriber.DefaultFinalizer']= array(0 => array(), 1 => array('finalize' => array(1 => array(0 => '[:var]', 1 => '[:lang.archive.Archive]', 2 => 'io.Folder'), 2 => 'void', 3 => array(), 4 => 'Finalize', 5 => array(), 6 => array())), 'class' => array(4 => 'The default finalizer just moves the created libraries to the
target directory', 5 => array(), 6 => array()));
?>

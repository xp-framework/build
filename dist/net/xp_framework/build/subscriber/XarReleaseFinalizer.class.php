<?php namespace net\xp_framework\build\subscriber;

;
;






interface XarReleaseFinalizer {




public function finalize(array $build,array $archives,\io\Folder $targetDir);}\xp::$cn['net\xp_framework\build\subscriber\XarReleaseFinalizer']= 'net.xp_framework.build.subscriber.XarReleaseFinalizer';\xp::$meta['net.xp_framework.build.subscriber.XarReleaseFinalizer']= array(0 => array(), 1 => array('finalize' => array(1 => array(0 => '[:var]', 1 => '[:lang.archive.Archive]', 2 => 'io.Folder'), 2 => 'void', 3 => array(), 4 => 'Finalize', 5 => array(), 6 => array())), 'class' => array(4 => 'A XAR release finalizer gets called once all archives have been created.', 5 => array(), 6 => array()));
?>

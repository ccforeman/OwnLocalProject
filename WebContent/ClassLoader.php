<?php 
/* 
 * Do not want to load classes individually in each file, so using
 * an auto-loader to avoid that hassle.
 * 
 */

function classAutoLoaderControllers($class) {
	$file = 'controllers/' . $class . '.class.php';
	
	if(file_exists($file)) {
		require $file;
	}

}

function classAutoLoaderModels($class) {
	$file = 'models/' . $class . '.class.php';
	
	if(file_exists($file)) {
		require $file;
	}
}
spl_autoload_register('classAutoLoaderControllers');
spl_autoload_register('classAutoLoaderModels');


?>
<?php 
/* 
 * Do not want to load classes individually in each file, so using
 * an auto-loader to avoid that hassle.
 * 
 */

function class_autoloader($class) {
	require $class . ".class.php";
}

spl_autoload_register('class_autoloader');
?>
<?php

define('OMNI_TXT_DOMAIN', 'omni-wp-theme');
define('OMNI_CORE_PATH', get_template_directory() . '/core/');

function omni_require_file( $path ) {
	if ( file_exists($path) ) {
		require $path;
	}
}
omni_require_file( OMNI_CORE_PATH . 'init.php' );

function p($var) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

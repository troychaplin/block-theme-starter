<?php
/**
 * Theme Functions
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include our bundled autoload if not loaded globally.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

// Instantiate our modules.
$bts_modules = array(
	new BTS\Enqueues(),
);

foreach ( $bts_modules as $bts_module ) {
	$bts_module->init();
}

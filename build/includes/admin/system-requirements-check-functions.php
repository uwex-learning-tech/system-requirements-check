<?php

if (!defined('ABSPATH')) exit; // exit if accessed directly

/**
 * prep_option function
 *
 * @access public
 * @param mixed $args
 * @return string
 *
 */
function prep_option($arg) {
	
	if (empty($arg))
		return '0';
		
	$arg = trim($arg);
	$arg = htmlentities($arg, ENT_QUOTES);
	return $arg;
	
}
?>
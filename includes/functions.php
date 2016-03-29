<?php

/*
	includes general functions for ICP module
*/

function icp_log( $content )
{
	$log_content = date("Y-m-d:h-i-s") . " : " . $content ."\n\r";
	error_log( $log_content, 3, PLUGIN_DIR."/log.txt");
}
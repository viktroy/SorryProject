<?php

if (!function_exists("debug_out")) {
	if (defined('DEBUG') && DEBUG == TRUE) {
		function debug_out($str, $flag=NULL) {
			if(!($flag == FALSE)) {
				print "DEBUG: " . $str . "<br/>\n";
			}
		}
	} else {
		function debug_out($str, $flag=NULL) {
		}
	}
}
?>
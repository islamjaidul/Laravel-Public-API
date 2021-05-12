<?php

/**
 * Remove http, https, www from URL
 *
 * @param $url | string
 * @return string
*/
if (!function_exists('removeHttp')) {
	function removeHttp(string $url) : string
	{
		return str_replace("www.", "", preg_replace("(^https?://)", "", $url));
	}
}
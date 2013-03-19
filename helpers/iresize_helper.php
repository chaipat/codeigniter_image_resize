<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('iresize'))
{
	function iresize($image_src = '', $width = 0, $height = 0)
	{
		$CI =& get_instance();
		return $CI->resize_lib->resize(trim($image_src), $width, $height);
	}
}
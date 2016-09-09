<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('get_val')){
	function get_val($arr, $key, $fallback = NULL)
	{
		return isset($arr[$key]) ? $arr[$key] : $fallback;
	}
}

if(!function_exists('months_dropdown')){
	function months_dropdown($name, $val, $attrs = 'class="form-control"')
	{
		$months = ['' => ''];
		foreach(cal_info(0)['months'] AS $key => $month){
			$months[str_pad($key, 2, 0, STR_PAD_LEFT)] = $month;
		}
		return form_dropdown($name, $months, $val, $attrs);
	}
}

if(!function_exists('days_dropdown')){
	function days_dropdown($name, $val, $attrs = 'class="form-control"')
	{
		$days = ['' => ''];
		for($x = 1; $x < 32; $x++){
			$days[str_pad($x, 2, 0, STR_PAD_LEFT)] = $x;
		}
		return form_dropdown($name, $days, $val, $attrs);
	}
}

if(!function_exists('get_days_array')){
	function get_days_array()
	{
		$days = [];
		for($x = 1; $x < 32; $x++){
			$days[] = str_pad($x, 2, 0, STR_PAD_LEFT);
		}
		return $days;
	}
}

if(!function_exists('years_dropdown')){
	function years_dropdown($name, $val, $attrs = 'class="form-control"')
	{
		$years = ['' => ''];
		foreach(array_reverse(range(1900, date('Y'))) AS $year){
			$years[$year] = $year;
		}
		return form_dropdown($name, $years, $val, $attrs);
	}
}
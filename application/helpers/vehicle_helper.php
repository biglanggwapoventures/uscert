<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('vehicle_type_dropdown')){
	function vehicle_type_dropdown($name, $val = FALSE, $attrs = 'class="form-control"')
	{
		$CI =& get_instance();
		$CI->load->model('Vehicle_type_model', 'vtype');
		$list = $CI->vtype->all();
		return form_dropdown($name, ['' => ''] + array_column($list, 'name', 'id'), $val, $attrs);
	}
}

if(!function_exists('vehicle_type_exists')){
	function vehicle_type_exists($id)
	{
		$CI =& get_instance();
		$CI->load->model('Vehicle_type_model', 'vtype');
		return $CI->vtype->exists($id);
	}
}
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

if(!function_exists('vehicle_multiselect')){
	function vehicle_multiselect($name, $val = FALSE, $attrs = 'class="form-control"', $within_org_only = FALSE)
	{
		$CI =& get_instance();
		$CI->load->model('Vehicle_model', 'v');
		if($within_org_only){
			$CI->v->where(['organization_id' => user('organization_id')]);
		}
		$data = $CI->v->all();
		$items = [];
		foreach($data AS $row){
			$items[$row['id']] = "{$row['name']} [{$row['plate_number']}]";
		}
		return form_multiselect($name, $items, $val, $attrs);
	}
}
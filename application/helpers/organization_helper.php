<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('organization_dropdown')){
	function organization_dropdown($name, $val = FALSE, $attrs = 'class="form-control"')
	{
		$CI =& get_instance();
		$CI->load->model('Organization_model', 'org');
		$list = $CI->org->all();
		$format = ['' => ''];
		foreach($list AS $l){
			$format[$l['id']] = "{$l['name']} [{$l['acronym']}]";
		}
		return form_dropdown($name, $format, $val, $attrs);
	}
}

if(!function_exists('organization_exists')){
	function organization_exists($id)
	{
		$CI =& get_instance();
		$CI->load->model('Organization_model', 'org');
		return $CI->org->exists($id);
	}
}
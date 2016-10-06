<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('login_type')){
	function login_type($type = FALSE)
	{
		$CI =& get_instance();
		$login_type =  $CI->session->userdata('login_type');
		return $type ? $login_type === $type : $login_type;
	}
}

if(!function_exists('login_type_description')){
	function login_type_description($type)
	{
		switch ($type) {
			case 'v':
				return 'RESPONDER';
			case 'a':
				return 'ADMIN';
			case 'sa':
				return 'SUPER ADMIN';
			default:
				return 'UNKNOWN USER ROLE';
		}
	}
}


if(!function_exists('user')){
	function user($prop = NULL, $val = FALSE)
	{
		$CI =& get_instance();
		$user =  $CI->session->userdata($prop);
		return $val ? $user === $val : $user;
	}
}


if(!function_exists('user_multiselect')){
	function user_multiselect($name, $val = FALSE, $attrs = 'class="form-control"', $within_org_only = FALSE)
	{
		$CI =& get_instance();
		$CI->load->model('User_model', 'u');
		if($within_org_only){
			$CI->u->where(['organization_id' => user('organization_id')]);
		}
		$data = $CI->u->all();
		foreach($data AS $row){
			$items[$row['id']] = $row['fullname'] ? "{$row['fullname']} (@{$row['login_username']})" : $row['login_username'];
		}
	
		return form_multiselect($name, $items, $val, $attrs);
	}
}
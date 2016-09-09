<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller {

	protected $tabTitle = 'Attendance';
	protected $contentTitle = 'Attendance';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Attendance_model', 'attendance');
		$this->load->model('User_model', 'user');
		$this->load->helper('date2');
	}
	 
	function index()
	{
		$year = $this->input->get('year') ?: date('Y');
		$month = $this->input->get('month') ?: date('m');
		$member = $this->input->get('responder_id') ?: user('id');

		$date = "{$year}-{$month}-01";

		$timeLogs = $this->attendance->get($member, $month, $year);
		$orgMembers = $this->user->where([ 'organization_id' => user('organization_id') ])->all();

		$this->generate_page('attendance', [
			'chosenDate' => $date,
			'csrf_name' => $this->security->get_csrf_token_name(),
        	'csrf_hash' => $this->security->get_csrf_hash(),
        	'org_members' => $orgMembers,
			'logs' => $timeLogs,
			'memberProfile' => $this->user->get($member)
		]);
	}

	function modify_log()
	{
		$params = elements(['pk', 'name', 'value'], $this->input->post());
		if(is_valid_date($params['value'], 'H:i:s') && is_numeric($params['pk']) && in_array($params['name'], ['datetime_in', 'datetime_out'])){
			$this->attendance->modify_log($params['pk'], $params['name'], $params['value']);
		}else{
			echo 0;
		}
	}
}

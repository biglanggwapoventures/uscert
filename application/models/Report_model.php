<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends MY_Model
{

	protected $table = 'incident_reports';

    const TYPE_CRASH = 'CRASH';
    const TYPE_FLOOD = 'FLOOD';
    const TYPE_EARTHQUAKE = 'EARTHQUAKE';
    const TYPE_FIRE = 'FIRE';
	
	function __construct()
	{
		parent::__construct();
	}

	function where($params)
	{
		$this->db->where($params);
		return $this;
	}

	function all()
	{
		$data = $this->db->select('r.*, u.login_username AS responder, o.name AS organization, ua.login_username AS approver')
			->from($this->table.' AS r')
			->join('users AS u', 'u.id = r.created_by', 'left')
			->join('users AS ua', 'ua.id = r.approved_by', 'left')
			->join('organizations AS o', 'o.id = u.organization_id', 'left')
			->order_by('incident_date DESC, id DESC')
			->get()
			->result_array();
		foreach($data AS &$row){
			$row['key_details'] = json_decode($row['key_details'], TRUE);
		}
		return $data;
	}

	function get($id)
	{
		$data = parent::get($id);
		$data['key_details'] = json_decode($data['key_details'], TRUE);
		return $data;
	}

	function is_approved($id)
	{
		return $this->db->select('id')
			->from($this->table)
			->where('id', $id)
			->where('approved_by IS NOT NULL')
			->get()
			->num_rows() > 0;
	}

}
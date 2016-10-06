<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends MY_Model
{

	protected $table = 'vehicles';
	
	function __construct()
	{
		parent::__construct();
	}

	function all()
	{
		return $this->db->select('v.id, v.name, v.plate_number, o.name AS organization, vt.name AS type')
			->from($this->table. ' AS v')
			->join('organizations AS o', 'o.id = v.organization_id')
			->join('vehicle_types AS vt', 'vt.id = v.vehicle_type_id')
			->get()
			->result_array();
	}

	function where($params)
	{
		$this->db->where($params);
		return $this;
	}


}
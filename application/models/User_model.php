<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{

	protected $table = 'users';
	
	function __construct()
	{
		parent::__construct();
	}

	function where($column, $val = NULL)
	{
		if(is_array($column)){
			$params = [];
			foreach ($column as $key => $value) {
				$params["u.{$key}"] = $value;
			}
			$this->db->where($params);
		}else{
			$this->db->where("u.{$column}", $val);
		}
		
		return $this;
	}

	function all()
	{
		return $this->db->select('u.*, CONCAT(p.lastname, ", ", p.firstname) AS fullname, o.name AS organization', FALSE)
			->from($this->table. ' AS u')
			->join('organizations AS o', 'o.id = u.organization_id', 'left')
			->join('persons AS p', 'p.id = u.person_id', 'left')
			->get()
			->result_array();
	}

	function get($id)
	{
		return $this->db->select('u.login_username, u.login_type, o.name AS organization, p.*')
			->from($this->table. ' AS u')
			->join('persons AS p', 'p.id = u.person_id', 'left')
			->join('organizations AS o', 'o.id = u.organization_id', 'left')
			->where('u.id', $id)
			->get()
			->row_array();
	}

	function auth($username, $password)
	{
		return $this->db->select('u.id, u.login_username, u.login_type, u.organization_id, u.person_id, o.name AS organization, CONCAT(p.lastname, ", ", p.firstname) AS fullname', FALSE)
			->from($this->table.' AS u')
			->join('persons AS p', 'p.id = u.person_id', 'left')
			->join('organizations AS o', 'o.id = u.organization_id', 'left')
			->where([
				'u.login_username' => $username,
				'u.login_password' => md5($password)
			])
			->get()
			->row_array();
	}


	function save_profile($id, $profile)
	{
		$user = $this->db->select('person_id')
			->get_where($this->table, ['id' => $id])
			->row_array();

		if(isset($user['person_id']) && trim($user['person_id'])){

			$this->db->update('persons', $profile, ['id' => $user['person_id']]);
			return TRUE;

		}else{
			
			$this->db->trans_start();

			$this->db->insert('persons', $profile);

			$person_id = $this->db->insert_id();

			$this->db->update($this->table, ['person_id' => $person_id], ['id' => $id]);
			
			$this->db->trans_complete();

			return $this->db->trans_status();

		}
	}


}
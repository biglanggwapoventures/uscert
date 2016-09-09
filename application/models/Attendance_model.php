<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends MY_Model
{

	protected $table = 'attendance';
	
	function __construct()
	{
		parent::__construct();
	}

	function time_in($userId)
	{
		$hasLoggedIn = $this->db->select('id')
			->from($this->table)
			->where('user_id', $userId)
			->where('DATE(datetime_in) = CURDATE()')
			->get()
			->num_rows() > 0;
		
		if(!$hasLoggedIn){
			$this->db->insert($this->table, [
				'user_id' => $userId,
				'datetime_in' => NULL
			]);
			return $this->db->affected_rows() > 0;
		}

		return TRUE;
	}

	function time_out($userId)
	{	
		$this->db->where('user_id', $userId)
			->where('DATE(datetime_in) = CURDATE()')
			->order_by('datetime_in', 'DESC')
			->limit(1)
			->set('datetime_out', $datetime)
			->update($this->table);

		return TRUE;
	}

	function modify_log($logId, $columnName, $newTime)
	{
		// UPDATE yourtable SET yourcolumn=concat(date(yourcolumn), ' 21:00:00') WHERE Id=yourid;
		$this->db->set($columnName, "CONCAT(DATE(datetime_in), ' {$newTime}')", FALSE);
		$this->db->where('id', $logId)->update($this->table);
	}

	function get($userId = FALSE, $month = NULL, $year = NULL)
	{
		$userId = $userId ?: user('id');

		if($month){
			$this->db->where("MONTH(datetime_in) = '{$month}'");
		}

		if($year){
			$this->db->where("YEAR(datetime_in) = '{$year}'");
		}

		return $this->db->select('id, DATE(datetime_in) AS log_date, TIME(datetime_in) AS time_in, TIME(datetime_out) AS time_out, datetime_in, datetime_out', FALSE)
			->from($this->table)
			->where('user_id', $userId)
			->get()
			->result_array();
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller {

	protected $tabTitle = 'Attendance';
	protected $contentTitle = 'Attendance';
	 
	public function index()
	{
		$this->generate_page('attendance');
	}
}

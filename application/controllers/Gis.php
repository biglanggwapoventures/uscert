<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gis extends MY_Controller {
	 
    protected $tabTitle = 'GIS';
    protected $contentTitle = 'GIS';


	function index()
	{
		$this->generate_page('gis');
	}

	function get_reports()
	{
		$this->load->model('Report_model', 'report');
		$data = $this->report->where('approved_by IS NOT NULL')->all();
		$this->generate_json($data);
	}
}

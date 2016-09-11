<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gis extends MY_Controller {
	 
    protected $tabTitle = 'GIS';
    protected $contentTitle = 'GIS';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Map_marker_model', 'marker');
		$this->load->model('Report_model', 'report');
	}


	function index()
	{
		$this->generate_page('gis');
	}

	function get_reports()
	{
		$data = $this->report->where('approved_by IS NOT NULL')->all();
		$this->generate_json($data);
	}

	function get_markers()
	{
		$data = $this->marker->all();
		$this->generate_json($data);
	}

	function save_marker()
	{
		$validator = $this->validate();
		if($validator['result']){
			$id = $validator['data']['id'];
			unset($validator['data']['id']);
			if($id){
				 $this->marker->update($id, $validator['data']);
				 $this->generate_json(['result' => TRUE]);
			}else{
				$id = $this->marker->create($validator['data']);
				$this->generate_json([
					'result' => TRUE,
					'data' => compact('id')
				]);
			}
			return;
		}
		$this->generate_json($validator);
	}

	function remove_marker()
	{
		$id = $this->input->post('id');
		if($this->marker->exists($id)){
			$this->marker->delete($id);
		}
		$this->generate_json(['result' => TRUE]);
	}

	function validate()
	{
		$input = $this->input->post();
		$this->form_validation->set_rules('latitude', 'latitide', 'required|decimal');
		$this->form_validation->set_rules('longitude', 'longitude', 'required|decimal');
		$this->form_validation->set_rules('status', 'status', 'required|in_list[0,1]');
		$this->form_validation->set_rules('formatted_address', 'full address', 'required');

		if(isset($input['id'])){
			$this->form_validation->set_rules('id', 'marker', [[
				'marker_exists', function($val){
					return $this->marker->exists($val);
				}
			]], ['marker_exists' => 'The %s you are trying to update does not exist.']);
		}

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['latitude', 'longitude', 'status', 'formatted_address', 'id'], $input, FALSE)
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}
}

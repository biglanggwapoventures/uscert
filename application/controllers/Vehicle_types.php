<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_types extends MY_Controller 
{

	protected $tabTitle = 'Vehicle Types';
	protected $contentTitle = 'Vehicle Types';

	protected $viewPath = 'vehicle-types';
	protected $resourceName = 'vehicle-types';

	protected $subject = 'vehicle type';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!login_type('a')) redirect('dashboard');
		$this->load->model('Vehicle_type_model', 'vehicle_type');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->vehicle_type->all(),
			'csrf_name' => $this->security->get_csrf_token_name(),
        	'csrf_hash' => $this->security->get_csrf_hash()
		]);
	}

	function create()
	{
		$this->generate_page('manage', [
			'title' => "Create new {$this->subject}",
			'action' => "{$this->resourceName}/store",
			'data' => []
		]);
	}

	function store()
	{
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$created = $this->vehicle_type->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$vehicle_type = $this->vehicle_type->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$vehicle_type['name']}",
			'data' => $vehicle_type,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->vehicle_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->vehicle_type->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->vehicle_type->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->vehicle_type->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'vehicle type name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->vehicle_type->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}

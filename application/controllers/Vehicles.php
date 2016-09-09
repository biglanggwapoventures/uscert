<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends MY_Controller 
{

	protected $tabTitle = 'Vehicles';
	protected $contentTitle = 'Vehicles';

	protected $viewPath = 'vehicles';
	protected $resourceName = 'vehicles';

	protected $subject = 'vehicle';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!login_type('a')) redirect('dashboard');
		$this->load->helper(['organization', 'vehicle']);
		$this->load->model('Vehicle_model', 'vehicle');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->vehicle->all(),
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
		$created = $this->vehicle->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$vehicle = $this->vehicle->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$vehicle['name']}",
			'data' => $vehicle,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->vehicle->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->vehicle->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->vehicle->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->vehicle->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'vehicle name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->vehicle->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		$this->form_validation->set_rules('plate_number', 'plate number', ['required',
			[
				'unique_plate_number', function($val){
					return $this->vehicle->has_unique('plate_number', $val, $this->id);
				}
			]
		], ['unique_plate_number' => 'The %s is already in use!']);
		

		$this->form_validation->set_rules('vehicle_type_id', 'vehicle type', ['required', 
			[
				'valid_vehicle_type',  
				function($val){
					return vehicle_type_exists($val);
				}
			]
		], ['valid_vehicle_type' => 'Please select a %s!']);

		$this->form_validation->set_rules('organization_id', 'organization', ['required', 
			[
				'valid_organization',  
				function($val){
					return organization_exists($val);
				}
			]
		], ['valid_organization' => 'Please select a %s!']);

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name', 'vehicle_type_id',  'plate_number', 'organization_id'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}

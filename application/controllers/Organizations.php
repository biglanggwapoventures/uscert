<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organizations extends MY_Controller 
{

	protected $tabTitle = 'Organizations';
	protected $contentTitle = 'Organizations';

	protected $viewPath = 'organizations';
	protected $resourceName = 'organizations';

	protected $subject = 'organization';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!login_type('sa')) redirect('dashboard');
		$this->load->model('Organization_model', 'org');
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->org->order_by('name')->all(),
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
		$created = $this->org->create($validate['data']);
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$org = $this->org->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$org['name']}",
			'data' => $org,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->org->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}
		$this->id = $id;
		$validate = $this->_validate();
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}
		$updated = $this->org->update($id, $validate['data']);
		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->org->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->org->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('name', 'organization name', ['required', 
			[
				'has_unique_name',  
				function($val){
					return $this->org->has_unique('name', $val, $this->id);
				}
			]
		], ['has_unique_name' => 'The %s is already in use!']);

		$this->form_validation->set_rules('acronym', 'acronym', 'required');

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => elements(['name', 'acronym'], $this->input->post())
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}

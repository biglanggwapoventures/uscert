<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers extends MY_Controller 
{

	protected $tabTitle = 'Responders';
	protected $contentTitle = 'Responders';

	protected $viewPath = 'volunteers';
	protected $resourceName = 'volunteers';

	protected $subject = 'responder';

	protected $id;

	function __construct()
	{
		parent::__construct();
		if(!login_type('a')) redirect('dashboard');
		$this->load->model('User_model', 'user');
		$this->load->helper(['organization', 'date2']);
	}
	 
	function index()
	{
		$this->generate_page('list', [
			'items' => $this->user->where([ 'login_type' => 'v', 'organization_id' => user('organization_id') ])->order_by('name')->all(),
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

		$validate['data']['login_password'] = md5($validate['data']['login_password']);
		$validate['data']['login_type'] = 'v';

		$created = $this->user->create($validate['data']);
		if($validate['extra']){
			 $this->user->save_profile($id, ['skills' => $validate['extra']]);
		}
		if($created){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function edit($id = FALSE)
	{
		if(!$id || !$user = $this->user->get($id)){
			show_404();
		}
		$this->generate_page('manage', [
			'title' => "Update {$this->subject}: {$user['login_username']}",
			'data' => $user,
			'action' => "{$this->resourceName}/update/{$id}",
		]);
	}

	function update($id = FALSE)
	{
		if(!$id || !$this->user->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to update does not exist!"]);
			return;
		}

		$this->id = $id;

		$validate = $this->_validate();
		
		if(!$validate['result']){
			$this->generate_json($validate);
			return;
		}

		if($validate['data']['login_password']){
			$validate['data']['login_password'] = md5($validate['data']['login_password']);
		}else{
			unset($validate['data']['login_password']);
		}

		$updated = $this->user->update($id, $validate['data']);
		if($validate['extra']){
			 $this->user->save_profile($id, ['skills' => $validate['extra']]);
		}

		if($updated){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function delete()
	{
		$id = $this->input->post('id');		
		if(!$this->user->exists($id)){
			$this->generate_json(['result' => FALSE, 'errors' => "The {$this->subject} you are trying to delete does not exist!"]);
			return;
		}
		$deleted = $this->user->delete($id);
		if($deleted){
			$this->generate_json(['result' => TRUE]);
			return;
		}
		$this->generate_json(['result' => FALSE]);
	}

	function _validate()
	{
		$this->form_validation->set_rules('login_username', 'login username', ['required', 
			[
				'has_unique_login_username',  
				function($val){
					return $this->user->has_unique('login_username', $val, $this->id);
				}
			]
		], ['has_unique_login_username' => 'The %s is already in use!']);

		$this->form_validation->set_rules('organization_id', 'organization', ['required', 
			[
				'existing_organization',  
				function($val){
					return organization_exists($val);
				}
			]
		], ['existing_organization' => 'Please select an %s.']);

		$requirePassword = !$this->id ? '|required' : '';
		$this->form_validation->set_rules('login_password', 'login password', "min_length[4]{$requirePassword}");
		if($this->input->post('login_password')){
			$this->form_validation->set_rules('password_confirmation', 'password confirmation', "required|matches[login_password]");
		}

		$data = elements(['login_username', 'login_password', 'organization_id'], $this->input->post());
		$data['locked'] = $this->input->post('locked') ? 1 : 0;

		if($this->form_validation->run()){
			return [
				'result' => TRUE,
				'data' => $data,
				'extra' => $this->input->post('skills')
			];
		}
		return [
			'result' => FALSE,
			'errors' => $this->form_validation->errors()
		];
	}

}

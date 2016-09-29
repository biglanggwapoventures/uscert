<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->model('Attendance_model', 'attendance');
	}
	 
	function attempt()
	{
		$this->output->set_content_type('json');

		$this->form_validation->set_rules('login_username', 'username', ['required', [
			'validate_locked', function($username){
				return !$this->user->is_locked($username);
			}
		]], ['validate_locked' => 'Account is locked. Please contact administrator']);
		$this->form_validation->set_rules('login_password', 'password', 'required');

		if(!$this->form_validation->run()){
			$this->output->set_output(json_encode([
				'result' => FALSE, 
				'errors' => $this->form_validation->errors()
			]));
			return;
		}

		$auth = elements(['login_username', 'login_password'], $this->input->post());
		if($user = $this->user->auth($auth['login_username'], $auth['login_password'])){
			$this->session->set_userdata($user);
			$this->attendance->time_in(user('id'));
			$this->output->set_output(json_encode(['result' => TRUE]));
			return;
		}
		$this->output->set_output(json_encode(['result' => FALSE, 'errors' => ['Invalid username / password']]));
	}

	function logout()
	{
		$this->attendance->time_out(user('id'));
		session_destroy();
		redirect('welcome');
	}
}

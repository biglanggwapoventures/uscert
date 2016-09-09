<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller 
{

	protected $tabTitle = 'My Profile';
	protected $contentTitle = 'My Profile';

	protected $viewPath = 'profile';
	protected $resourceName = 'profile';

	protected $subject = 'profile';

	protected $id;

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
        $this->load->helper('date2');
	}
	 
	function index()
	{
		$this->generate_page('manage', [
			'data' => $this->user->get(user('id')),
            'change_password_action' => "{$this->resourceName}/change-password",
            'update_profile_action' => "{$this->resourceName}/save",
		]);
	}

    function change_password()
    {
        $input = elements(['login_password', 'password_confirmation'], $this->input->post());
        $this->form_validation->set_rules('login_password', 'new password', 'required|min_length[4]');
        $this->form_validation->set_rules('password_confirmation', 'password confirmation', 'required|matches[login_password]');
        
        if($this->form_validation->run()){
            $this->user->update(user('id'), ['login_password' => MD5($input['login_password']) ]);
            $this->session->set_flashdata('submit-success', 'Your password has been changed successfully!');
            $this->generate_json([ 'result' => TRUE ]);
        }else{
            $this->generate_json([ 'result' => FALSE, 'errors' => $this->form_validation->errors() ]);
        }
    }

	function save($id = FALSE)
	{
        $input = $this->input->post();
        $errors = [];

        $this->form_validation->set_rules('firstname', 'first name', 'required');
        $this->form_validation->set_rules('lastname', 'last name', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required|in_list[MALE,FEMALE]');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('nationality', 'nationality', 'required');

        $birthday = implode('-', elements(['birthyear', 'birthmonth', 'birthdate'], $input, '-'));
        if(!is_valid_date($birthday)){
            $errors[] = 'Please input your birthdate.';
        }

        if($this->form_validation->run() && empty($errors)){
            $profile = elements(['firstname', 'lastname', 'gender', 'address', 'nationality', 'course', 'skills'], $input, NULL);
            $profile['birthdate'] = $birthday;
            $this->user->save_profile(user('id'), $profile);
            $this->session->set_flashdata('submit-success', 'Your profile has been successfully updated!');
            $this->generate_json([ 'result' => TRUE ]);
        }else{
            $messages = $this->form_validation->errors() + $errors;
            $this->generate_json([ 'result' => FALSE, 'errors' => $messages ]);
        }
        
        
	}
}

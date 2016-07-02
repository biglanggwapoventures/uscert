<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organizations extends MY_Controller {

	protected $tabTitle = 'Organizations';
	protected $contentTitle = 'Organizations';
	 
	function index()
	{
		$this->generate_page('organizations/list');
	}

	function create()
	{
		$this->generate_page('organizations/manage');
	}

}

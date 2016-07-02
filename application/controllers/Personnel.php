<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personnel extends MY_Controller {

	protected $tabTitle = 'Personnel';
	protected $contentTitle = 'Personnel';
	 
	function index()
	{
		$this->generate_page('personnel/list');
	}

	function create()
	{
		$this->generate_page('personnel/manage');
	}

}

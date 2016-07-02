<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	 
    protected $tabTitle = 'Home';
    protected $contentTitle = 'Home';


	public function index()
	{
		$this->generate_page('home');
	}
}

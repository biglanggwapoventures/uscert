<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidents extends MY_Controller {

	protected $tabTitle = 'Incidents';
	protected $contentTitle = 'Incidents';
	 
	function index()
	{
		$this->generate_page('incidents/list');
	}

	function create()
	{
		$this->generate_page('incidents/manage', [
			'types' => [
				'ac' => 'Accidents',
				'ea' => 'Earthquake',
				'Fire' => 'Fire'
			]
		]);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends MY_Controller {

	protected $tabTitle = 'Vehicles';
	protected $contentTitle = 'Vehicles';
	 
	function index()
	{
		$this->generate_page('vehicles/list');
	}

	function create()
	{
		$this->generate_page('vehicles/manage', [

			'organizations' => [
				1 => 'ERUF',
				2 => 'Fire Truck Org.'
			],
			'vehicleTypes' => [
				'amb' => 'Ambulance',
				'ft' => 'Fire Truck'
			]
			
		]);
	}

}

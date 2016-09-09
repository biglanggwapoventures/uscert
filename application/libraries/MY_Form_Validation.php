<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	function __construct()
	{
		parent::__construct();
	}

	function errors()
	{
		return array_values($this->error_array());
	}
}
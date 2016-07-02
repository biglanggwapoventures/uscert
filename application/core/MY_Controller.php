<?php

class MY_Controller extends CI_Controller
{
    protected $tabTitle = NULL;
    protected $contentTitle = NULL;

    function __construct()
    {
        parent::__construct();
    }

    function generate_page($view, $data = FALSE)
    {
        $content = $this->load->view($view, $data, TRUE);
        $this->load->view('app', [
            'tabTitle' => $this->tabTitle,
            'contentTitle' => $this->contentTitle,
            'content' => $content
        ]);
    }


}
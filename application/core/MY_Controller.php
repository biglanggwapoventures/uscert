<?php

class MY_Controller extends CI_Controller
{
    protected $tabTitle = NULL;
    protected $contentTitle = NULL;
    protected $viewPath = '';

    function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('id')){
            redirect('welcome');
        }
    }

    function generate_page($view, $data = FALSE)
    {
        $content = $this->load->view(trim($this->viewPath, '/').'/'.$view, $data, TRUE);
        $this->load->view('app', [
            'tabTitle' => $this->tabTitle,
            'contentTitle' => $this->contentTitle,
            'content' => $content
        ]);
    }

    function generate_json($data)
    {
        $this->output->set_content_type('json');
        $this->output->set_output(json_encode($data));
    }

    function user($prop = FALSE)
    {
        return $this->session->userdata($prop);
    }


}
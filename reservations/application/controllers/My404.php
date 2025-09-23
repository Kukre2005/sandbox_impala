<?php 
class My404 extends MIK_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        redirect('/');
        $this->output->set_status_header('404'); 
        $data['mo'] = 'error_404'; // View name 
        $this->load->view('index',$data);//loading in my template 
    } 
} 
?> 
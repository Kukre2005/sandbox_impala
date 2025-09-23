<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends MIK_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $data = array();
        $data['mo'] = "home";
        $data['pagedata'] = "home";
        $this->load->view('index', $data);
    }

    public function todosSantos() {
        $data = array();
        $data['mo'] = "todos-santos";
           $data["dbHotels"] = $this->Commonmodel->get_data("hotels", "status = '1'", "*");
        $this->load->view('index', $data);
    }

    public function cityTour() {
        $data = array();
        $data['mo'] = "city-tour";
           $data["dbHotels"] = $this->Commonmodel->get_data("hotels", "status = '1'", "*");
        $this->load->view('index', $data);
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MIK_Controller {

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
        $data['mo'] = "about";
        $this->load->view('index', $data);
    }
    
    
    public function airportinfo()
    {
        $data = array();
        $data['mo'] = "airport-info";
        $dbActList=$this->Commonmodel->get_data("airportinfo","status = '1' and type='airport'","*,concat('".site_url(AIRPORT_IMAGES_ORIGINAL)."/',image) as image");
        $data['dbAirport']=$dbActList;
       $this->load->view('index', $data);
    }
    
    public function services()
    {
        $data = array();
        $data['mo'] = "services";
        $dbActList=$this->Commonmodel->get_data("airportinfo","status = '1' and type='service'","*,concat('".site_url(AIRPORT_IMAGES_ORIGINAL)."/',image) as image");
        $data['dbAirport']=$dbActList;
       $this->load->view('index', $data);
    }
    
    public function whatToDo()
    {
        $data = array();
        $data['mo'] = "whattodo";
        $dbActList=$this->Commonmodel->get_data("activities","status = '1'","*,concat('".site_url(ACTIVITY_IMAGES_ORIGINAL)."/',image) as image");
        $data['dbActList']=$dbActList;
       $this->load->view('index', $data);
    }
    
    public function history()
    {
        $data = array();
        $data['mo'] = "history";
       $this->load->view('index', $data);
    }

   
    public function qa()
    {
        $data = array();
        $data['mo'] = "qa";
        $table="qatitles";
        $table2="qa";
        $dbQa = $this->Commonmodel->get_data($table,"status = '1'","id,name","id desc");
        foreach($dbQa as $q=>$qa)
        {
            $dbQa[$q]['data']=$this->Commonmodel->get_data($table2,"status = '1' and qaId = '".$qa['id']."'","name,description,concat('".QA_IMAGES_ORIGINAL."/',image) as qaimage,image");
        }
        $data['dbQa']=$dbQa;
       $this->load->view('index', $data);
    }

}

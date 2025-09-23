<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends MIK_Controller {

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
    public function index($slug) {
        $data = array();
        
        $data['mo'] = "activity";
        if(!empty($slug))
        {
            $table="activities";
            $table2="subactivities";
            $dbAct=$this->Commonmodel->get_single_data($table,"slug = '$slug'","*");
            $dbSubAct=$this->Commonmodel->get_data($table2,"actId = '".$dbAct['id']."'","*,concat('".  site_url(ACTIVITY_IMAGES_ORIGINAL)."/',image) as image");
            $data['dbActList']=$dbAct;
            $data['dbSubAct']=$dbSubAct;
            $data["dbHotels"] = $this->Commonmodel->get_data("hotels", "status = '1'", "*");
            $this->load->view('index', $data);
        }else{
            redirect(site_url());
        }
        
    }
    
    
    public function contact()
    {
        $data = array();
        $data['mo'] = "contact";
        $data['pagedata'] = "contact";
        $this->load->view('index', $data);
    }
    
    public function saveQuote() {
        $this->load->model("Email_model");
        $data = array();
        $status = 200;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($this->input->post('info',TRUE));
            $info['service'] = "one_way";
            $c = 0;
            $dbAct=$this->Commonmodel->get_single_data("activities","id = '$actId'","*");
            $rules['info[name]'] = array('name', 'required|min_length[5]');
            $rules['info[email]'] = array('email', 'required|valid_email');
            $rules['info[phone]'] = array('phone no', 'required|numeric');
            $rules['info[reservationDate]'] = array('reservation date', 'required');
            $rules['info[hotelId]'] = array('hotel', 'required');
            // $rules['info[service]'] = array('type of service', 'required');
            $rules['info[resturant]'] = array('restaurant', 'required');
            $rules['info[adults]'] = array('no. of adults', 'required|numeric');
            $rules['info[kids]'] = array('no. of kids', 'required|numeric');
            $rules['info[comments]'] = array('comments', 'required');
            $this->Commonmodel->setFormsValidation($rules);
            if ($this->form_validation->run() == TRUE) {
                $info = $this->input->post('info',TRUE);
                $info['service'] = "one_way";
                $info['createdAt'] = date("Y-m-d H:i:s");
                $info['reservationDate'] = date('Y-m-d',  strtotime($info['reservationDate']));
                $this->Commonmodel->save_data("quotes", $info);
               $hotelName =$this->Commonmodel->get_table_field("hotels", "id = '".$info['hotelId']."'","name");
                $to = SITE_EMAIL;
                $subject = "A user has sent a quote with " . SITE_NAME . ".";
                $msgBody = '<html><body>';
                $msgBody .= '<img src="'.site_url('assets/img/logo.png').'" alt="Insideloscabos" />';
                $msgBody.="<h3>Hello Admin,</h3>";
                $msgBody.="<p>A user has sent a quote for - ".ucwords($dbAct['name']).".Please check the following details:</p>";
                $msgBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($info['name']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($info['email']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($info['phone']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Activity:</strong> </td><td>" . strip_tags($dbAct['name']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Reservation Date:</strong> </td><td>" . strip_tags(date('d/m/Y',  strtotime($reservationDate))) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Hotel:</strong> </td><td>" . $hotelName . "</td></tr>";
                // $msgBody .= "<tr><td><strong>Trip Type:</strong> </td><td>" . ucwords(str_replace("_","",$info['service'])) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Restaurant:</strong> </td><td>" . strip_tags($info['resturant']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Adults:</strong> </td><td>" . strip_tags($info['adults']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Kids:</strong> </td><td>" . strip_tags($info['kids']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Comments:</strong> </td><td>" . htmlentities($info['comments']) . "</td></tr>";
                $msgBody .= "</table>";
                $msgBody .= '<br><div>Regards,<br><br>';
                $msgBody .= "<strong>" . SITE_NAME . "</strong><br><br>";
                $msgBody .= '<img src="' . site_url('assets/img/newlogo.png') . '" alt="Insideloscabos" />';
                $msgBody .= "</body></html>";
                $o = $this->Email_model->sendEmail($to, $subject, $msgBody, "", FROM_EMAIL, FROM_NAME);
                if($o == true)
                {
                    $message = "Thank you for sending us your quote.We will get back to you soon.";
                }else{
                    $message = "Error occurred during sending mail.Please try again.";
                }
                
            } else {
                $status = 201;
                $message = strip_tags(validation_errors());
            }
        } else {
            $status = 201;
            $message = "Params are invalid.Please try again";
        }
        $data['status'] = $status;
        $data['message'] = $message;
        echo json_encode($data);
    }

}

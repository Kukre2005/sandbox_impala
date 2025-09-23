<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MIK_Controller {

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
        $data['isHOME'] = "yes";
        $data['slider_coupon'] = $this->Commonmodel->get_single_data("coupons",array('is_public' => 1, "is_slider2_coupon" => 1, "end_date >=" => date('Y-m-d')));
        $this->load->view('index', $data);
    }

    public function contact() {
        $data = array();
        $data['mo'] = "contact";
        $this->load->library('recaptcha');
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html('',true);
        $data["dbHotels"] = $this->Commonmodel->get_data("hotels", "status = '1'", "*","name asc");
        $this->load->view('index', $data);
    }
     public function createCaptcha()
    {
        $data = array();
        $this->load->library('recaptcha');
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
        $data['mo'] = "captcha";
       $this->load->view('module/captcha', $data);
    }
    
    public function privacyPolicy() {
        $data = array();
        $data['mo'] = "privacy";
        $this->load->view('index', $data);
    }

    public function gallery() {
        $data = array();
        $data['mo'] = "gallery";
        $data["gallery"] = $this->Commonmodel->get_data("gallery", "id > '0'", "*","id DESC");
        $this->load->view('index', $data);
    }

    public function testimonials() {
        $data = array();
        $data['mo'] = "testimonials";
        $data["testimonials"] = $this->Commonmodel->get_data("testimonials", "id > '0'", "*","id DESC");
        $this->load->view('index', $data);
    }

    public function sitemap() {
        $data = array();
        $data['mo'] = "sitemap";
        $this->load->view('index', $data);
    }

    public function tos() {
        $data = array();
        $data['mo'] = "tos";

        $this->load->view('index', $data);
    }

    public function bookIt() {
        $data = array();
        $data['mo'] = "bookit";
        $this->load->library('recaptcha');
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
        $this->load->view('bookit',$data);
    }

    public function bookItDone() {
        $data = array();
        $data['mo'] = "bookitdone";
        $this->load->view('index',$data);
    }


    public function subscribe() {
        $data = array();
        $status = 200;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($_POST['info']);
            $c = 0;
            if (!empty($semail) && $semail) {
                $c = $this->Commonmodel->get_count("subscribe", "email = '$semail'");
            }
            $rules['info[semail]'] = array('email', 'required|valid_email|callback_checkExists[' . $c . '|Your details are already submitted]');
            $rules['info[sname]'] = array('name', 'required');
            $this->Commonmodel->setFormsValidation($rules);
            if ($this->form_validation->run() == TRUE) {
                $info = $this->input->post("info");
                $info2['email']=$info['semail'];
                $info2['name']=$info['sname'];
                $this->Commonmodel->save_data("subscribe", $info2);
                $message = "You details are successfully submitted for subscription";
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

    public function saveContact() {
        $data = array();
        $status = 200;
         $this->load->library('recaptcha');
        $message = "";
        $this->load->model("Email_model");
        if ($_POST && count($_POST) > 0) {
            extract($this->input->post('info',TRUE));
            $c = 0;
            $rules['info[name]'] = array('name', 'required|min_length[5]');
            $rules['info[email]'] = array('email', 'required|valid_email');
            $rules['info[phone]'] = array('phone no', 'required|numeric');
            $rules['info[passengers]'] = array('passengers', 'required|numeric');
            $rules['info[hotelId]'] = array('hotel', 'required');
            $rules['info[service]'] = array('type of service', 'required');
            $rules['info[arrivalFlight]'] = array('arrival flight detail', 'required');
            $rules['info[departureFlight]'] = array('departure flight detail', 'required');
            $rules['info[comments]'] = array('comments', 'required');
            $this->Commonmodel->setFormsValidation($rules);
            $this->recaptcha->recaptcha_check_answer();
            if ($this->form_validation->run() == TRUE && $this->recaptcha->getIsValid()) {
                $info = $this->input->post('info',TRUE);
                $info['createdAt'] = date("Y-m-d H:i:s");
                $this->Commonmodel->save_data("contact", $info);
               $hotelName =$this->Commonmodel->get_table_field("hotels", "id = '".$info['hotelId']."'","name");
                $to =FROM_CONTACT_EMAIL;
                $subject = "A user wants to contact with " . SITE_NAME . ".";
                $msgBody = '<html><body>';
                $msgBody .= '<img src="'.site_url('assets/img/logo.png').'" alt="Insideloscabos" />';
                  $msgBody.="<h3>Hello Admin,</h3>";
                $msgBody.="<p>A user wants to contact with " . SITE_NAME . "..Please check the following details:</p>";
                $msgBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($info['name']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($info['email']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($info['phone']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Passengers:</strong> </td><td>" . strip_tags($info['passengers']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Hotel:</strong> </td><td>" . $hotelName . "</td></tr>";
                $msgBody .= "<tr><td><strong>Type Of Services:</strong> </td><td>" . $info['service'] . "</td></tr>";
                $msgBody .= "<tr><td><strong>Arrival Flight Info: Airline, Flight Number and Time):</strong> </td><td>" . strip_tags($info['arrivalFlight']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Departure Flight Info: Airline, Flight Number and Time:</strong> </td><td>" . strip_tags($info['departureFlight']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Comments:</strong> </td><td>" . htmlentities($info['comments']) . "</td></tr>";
                $msgBody .= "</table>";
              $msgBody .= '<br><div>Regards,<br><br>';
                $msgBody .= "<strong>" . SITE_NAME . "</strong><br><br>";
                $msgBody .= '<img src="' . site_url('assets/img/newlogo.png') . '" alt="Insideloscabos" />';
                $msgBody .= "</body></html>";
                $o = $this->Email_model->sendEmail($to, $subject, $msgBody, "", FROM_EMAIL, FROM_NAME);
                if($o == true)
                {
                    $message = "Thanks for contacting us, our support team will get back to you shortly.";
                }else{
                    
                    $message = "Error occurred during sending mail.Please try again.";
//                    $message .= $o;
                }
                
            } else {
                $status = 201;
                $message = strip_tags(validation_errors());
                if(empty($message) && ($this->recaptcha->getError() != ''))
                {
                    $message = "Please enter valid captcha";
                }
            }
        } else {
            $status = 201;
            $message = "Params are invalid.Please try again";
        }
        $data['status'] = $status;
        $data['message'] = $message;
        echo json_encode($data);
    }


     public function saveBookit() {
        $data = array();
        $status = 200;
         $this->load->library('recaptcha');
        $message = "";
        $this->load->model("Email_model");
        if ($_POST && count($_POST) > 0) {
            $info = $this->input->post('info',TRUE);
            extract($this->input->post('info',TRUE));
            $c = 0;
            $rules['info[name]'] = array('name', 'required|min_length[5]');
            $rules['info[email]'] = array('email', 'required|valid_email');
            $rules['info[phone]'] = array('phone no', 'required|numeric');
            $rules['info[country]'] = array('country', 'required');
            $rules['info[staying]'] = array('where are you staying', 'required');
            $rules['info[service]'] = array('type of service', 'required');
            $rules['info[adults]'] = array('no of adults', 'required|numeric');
                $rules['info[kids]'] = array('no of kids', 'required|numeric');
             $rules['info[arrivalDate]'] = array('arrival date', 'required');
            $rules['info[arrivalFlight]'] = array('arrival flight detail', 'required');
                $rules['info[departureDate]'] = array('departure date', 'required');
                $rules['info[departureFlight]'] = array('departure flight detail', 'required');
            
            $rules['info[comments]'] = array('comments', 'required');
            $this->Commonmodel->setFormsValidation($rules);
            $this->recaptcha->recaptcha_check_answer();
            if ($this->form_validation->run() == TRUE && $this->recaptcha->getIsValid()) {
                $to =FROM_PAYPAL_EMAIL;
                $subject = "A user has submit its details in Book It with " . SITE_NAME . ".";
                $msgBody = '<html><body>';
                $msgBody .= '<img src="'.site_url('assets/img/logo.png').'" alt="Insideloscabos" />';
                  $msgBody.="<h3>Hello Admin,</h3>";
                $msgBody.="<p>A user has submit its details in Book It with " . SITE_NAME . ".Please check the following details:</p>";
                $msgBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $msgBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($info['name']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($info['email']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($info['phone']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Where are you staying:</strong> </td><td>" . strip_tags($info['staying']) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Your Country:</strong> </td><td>" . $info['country'] . "</td></tr>";
                $msgBody .= "<tr><td><strong>Type Of Service:</strong> </td><td>" . $info['service'] . "</td></tr>";
                 $msgBody .= "<tr><td><strong>Arrival Date:</strong> </td><td>" . strip_tags($arrivalDate) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Arrival Flight Info: Airline, Flight Number and Time):</strong> </td><td>" . strip_tags($info['arrivalFlight']) . "</td></tr>";
                    $msgBody .= "<tr><td><strong>Departure Date:</strong> </td><td>" . strip_tags($departureDate) . "</td></tr>";
                    $msgBody .= "<tr><td><strong>Departure Flight Info: Airline, Flight Number and Time:</strong> </td><td>" . strip_tags($info['departureFlight']) . "</td></tr>";
                
                    $msgBody .= "<tr><td><strong>Adults:</strong> </td><td>" . strip_tags($adults) . "</td></tr>";
                    $msgBody .= "<tr><td><strong>Kids:</strong> </td><td>" . strip_tags($kids) . "</td></tr>";
                $msgBody .= "<tr><td><strong>Comments:</strong> </td><td>" . htmlentities($info['comments']) . "</td></tr>";
                $msgBody .= "</table>";
              $msgBody .= '<br><div>Regards,<br><br>';
                $msgBody .= "<strong>" . SITE_NAME . "</strong><br><br>";
                $msgBody .= '<img src="' . site_url('assets/img/newlogo.png') . '" alt="Insideloscabos" />';
                $msgBody .= "</body></html>";
                $o = $this->Email_model->sendEmail($to, $subject, $msgBody, "", FROM_EMAIL, FROM_NAME);
                if($o == true)
                {
                    $message = "Thank you for contact us.We will get back to you soon.";
                }else{
                    
                    $message = "Error occurred during sending mail.Please try again.";
//                    $message .= $o;
                }
                
            } else {
                $status = 201;
                $message = strip_tags(validation_errors());
                if(empty($message) && ($this->recaptcha->getError() != ''))
                {
                    $message = "Please enter valid captcha";
                }
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

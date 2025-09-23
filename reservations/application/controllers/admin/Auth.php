<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MIK_Controller {

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
    public $userData;

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900); //300 seconds = 5 minutes
        ini_set('post_max_size', '200M');
        $this->userData = $this->session->userdata("loginData");
    }

    public function index() {

        $this->load->view('admin_view');
    }

    public function login() {
        $_POST = getJsonParam();
        extract($_POST);
        $respData = $data = array();
        $status = 200;
        $message = "";
        $rules['username'] = array('username', 'required');
        $rules['password'] = array('password', 'required');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == TRUE) {
            $password = md5($password);
            $dbAdmin = $this->Commonmodel->get_single_data('admin', "username = '$username' and password = '$password'", "*");
            if (count($dbAdmin) > 0) {
                $this->session->set_userdata('loginData', $dbAdmin);
                $data['loginData'] = $dbAdmin;
                $data['auth'] = true;
            } else {
                $status = 201;
                $message = "Invalid username/password";
            }
        } else {
            $status = 201;
            $message = strip_tags(validation_errors());
        }
        $respData['status'] = $status;
        $respData['message'] = $message;
        $respData['responseData'] = $data;
        echo json_encode($respData);
    }
    
    public function miniPass(){
        $_POST = getJsonParam();
        extract($_POST);
        $respData = $data = array();
        $status = 200;
        $message = "";
        $rules['miniPassword'] = array('mini password', 'required');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == TRUE) {
            $password = md5($miniPassword);
            $dbAdmin = $this->Commonmodel->get_single_data('admin', "miniPassword = '$password'", "*");
            if (count($dbAdmin) > 0) {
                $this->session->set_userdata('miniPass','1');
                
            } else {
                $status = 201;
                $message = "Invalid mini password";
            }
        } else {
            $status = 201;
            $message = strip_tags(validation_errors());
        }
        $respData['status'] = $status;
        $respData['message'] = $message;
        $respData['responseData'] = $data;
        echo json_encode($respData);
    }

    public function changeStatus() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if ($_POST && count($_POST) >= 3) {
            extract($_POST);
            if (isset($table) && isset($field) && isset($value) && isset($id)) {
                $o = $this->Commonmodel->update_data($table, array($field => $value), "id = '$id'");
                if ($o) {
                    $status = 200;
                    $message = "Status changed successfully";
                }
            }
        }
        $data = array();
        $data['status'] = $status;
        $data['message'] = $message;
        echo json_encode($data);
    }

    public function forgotPassword() {
        $_POST = getJsonParam();
        extract($_POST);
        $respData = $data = array();
        $status = 200;
        $message = "";
        $dbC = 0;
        if (!empty($email)) {
            $dbC = $this->Commonmodel->get_count('admin', "email = '$email'");
        }
        $rules['email'] = array('email', 'required|valid_email|callback_checkNotExists[' . $dbC . '|This email does not exists]');

        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == TRUE) {
            $data['np'] = $newPass = randomPassword();
            $md5NewPass = md5($newPass);
            $this->Commonmodel->update_data("admin", "password = '$md5NewPass'", "email = '$email'");
            $message = "We have reset your password.Please check your email";
        } else {
            $status = 201;
            $message = strip_tags(validation_errors());
        }
        $respData['status'] = $status;
        $respData['message'] = $message;
        $respData['responseData'] = $data;
        echo json_encode($respData);
    }

    public function getProfile() {
        $data = array();
        $status = 200;
        $message = "";
        $_POST = getJsonParam();
        extract($_POST);
        if ($id && !empty($id)) {
            $dbAdmin = $this->Commonmodel->get_single_data('admin', "id = '$id'", "*,concat('" . site_url(USER_IMAGES_ORIGINAL) . "/',image) as image");
            if (count($dbAdmin) > 0) {
                $data['responseData'] = $dbAdmin;
            } else {
                $status = 201;
                $message = "Unable to get data";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        echo json_encode($data);
    }

    public function checkLogin() {
        $respData = $data = array();
        $status = 200;
        $message = "";
        $respData['login'] = false;
        if ($this->session->userdata('loginData')) {
            $respData['login'] = true;
            
            $respData['miniPass'] = ($this->session->userdata('miniPass'))?$this->session->userdata('miniPass'):'0';
            $respData['loginData'] = $this->session->userdata('loginData');
        } else {
            $status = 201;
            $message = "";
        }
        $data['status'] = $status;
        $data['message'] = $message;
        $data['responseData'] = $respData;
        echo json_encode($data);
    }

    public function updateProfile() {
        extract($_POST);
        $table="admin";
        $respData = $data = array();
        $status = 200;
        $message = "";
        $rules['name'] = array('name', 'required');
        $rules['email'] = array('email', 'required|valid_email');
        $rules['mobile'] = array('mobile', 'required');
        $this->Commonmodel->setFormsValidation($rules);
        $dbdata = array();
        $im = "Please upload a image";
        $uData = $this->session->userdata("loginData");
        
        if (!empty($id)) {
            $im = 0;
            $dbdata = $this->Commonmodel->get_single_data($table, "id = '".$uData['id']."'", "*");
        }
        $info = $_POST;
        if ($this->form_validation->run() == TRUE) {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $imagename = time() . $_FILES['image']['name'];
                $im = $this->Commonmodel->uploadFile2('image', USER_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = USER_IMAGES_THUMB, $resize_dim = array('width' => '48', 'height' => '48'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im) {
                    $info['image'] = $imagename;
                }
            }
            $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
        }
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == TRUE) {
            
            $o = $this->Commonmodel->update_data("admin", $info, "id = '" . $uData['id'] . "'");
            if (!is_null($o)) {
                $message = "Profile updated successfully";
            } else {
                $status = 201;
                $message = "Some error occured.Please try again";
            }
        } else {
            $status = 201;
            $message = strip_tags(validation_errors());
        }
        $respData['status'] = $status;
        $respData['message'] = $message;
        $respData['responseData'] = $data;
        echo json_encode($respData);
    }

    public function changePassword() {
        $_POST = getJsonParam();
        extract($_POST);
        $respData = $data = array();
        $status = 200;
        $message = "";
        $c = 0;
        $id = $this->userData['id'];
        if ($currentPassword && !empty($currentPassword)) {
            $c = $this->Commonmodel->get_count("admin", "id = '$id' and password = '" . md5($currentPassword) . "'");
        }
        $rules['currentPassword'] = array('currentPassword', 'required|minlength[5]|callback_checkNotExists[' . $c . '|The current password is not valid]');
        $rules['newPassword'] = array('newPassword', 'required|minlength[5]');
        $rules['renewPassword'] = array('renewPassword', 'required|minlength[5]');
        $this->Commonmodel->setFormsValidation($rules);
        $uData = $this->session->userdata("loginData");
        if ($this->form_validation->run() == TRUE) {
            $info['password'] = md5($newPassword);
            $o = $this->Commonmodel->update_data("admin", $info, "id = '" . $uData['id'] . "'");
            if (!is_null($o)) {
                $message = "Password changed successfully";
            } else {
                $status = 201;
                $message = "Some error occured.Please try again";
            }
        } else {
            $status = 201;
            $message = strip_tags(validation_errors());
        }
        $respData['status'] = $status;
        $respData['message'] = $message;
        $respData['responseData'] = $data;
        echo json_encode($respData);
    }

    public function getSocial() {
        $respData = array();
        $respData['responseData'] = $this->Commonmodel->get_single_data("sociallinks", "id != ''", "*");
        $respData['status'] = (count($respData['responseData']) > 0) ? 200 : 201;
        $respData['message'] = "";

        echo json_encode($respData);
    }

    public function updateSocial() {
        $_POST = getJsonParam();
        extract($_POST);
        $respData = array();
        $status = 201;
        $r = array("facebook", "twitter", "linkedin", "googleplus");
        if ($this->input->post()) {
            foreach ($r as $t) {
                $rules[$t] = array($t, 'required|valid_url');
            }
            $this->Commonmodel->setFormsValidation($rules);
            if ($this->form_validation->run() == TRUE) {
                $info = $this->input->post();
                $o = $this->Commonmodel->update_data("sociallinks", $info, "id = 1");
                if (!is_null($o)) {
                    $message = "Record updated successfully";
                    $status = 200;
                } else {
                    $message = ERROR_RESPONSE;
                }
            } else {
                $message = strip_tags(validation_errors());
            }
        } else {
            $message = ERROR_RESPONSE;
        }
        $respData['responseData'] = array();
        $respData['status'] = $status;
        $respData['message'] = $message;


        echo json_encode($respData);
    }

    public function logout() {
        $data = array('status' => 200, 'message' => '');
        if ($this->session->userdata('loginData')) {
            $this->session->unset_userdata('loginData');
            $this->session->unset_userdata('miniPass');
            $data['message'] = "Logout successfully";
        }
        echo json_encode($data);
    }

}

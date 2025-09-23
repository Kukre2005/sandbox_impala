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
    public function airportInfo() {
        $_POST = getJsonParam();
        extract($_POST);
        $table = "airportinfo";
        $data = array();

        $where = "id != '' and type = '$type'";
        $lim = array();
        $fields = "*,concat('" . site_url(AIRPORT_IMAGES_THUMB) . "/',image) as image";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
        foreach ($dbData as $a => $air) {
            $dbData[$a]['description'] = html_entity_decode($air['description']);
        }
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function getAirport() {
        $_POST = getJsonParam();
        $id = "";
        $slug = "";
        $status = 201;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($_POST);
            if (!empty($actId) || !empty($slug)) {
                $table = "airportinfo";
                $data = array();
                $where = "id = '$actId'";
                $fields = "*";
                $dbData = $this->Commonmodel->get_single_data($table, $where, $fields);
                $data['data'] = $dbData;
                $status = 200;
            } else {
                $message = ERROR_PARAMS;
            }
        } else {
            $message = ERROR_RESPONSE;
        }
        $data['status'] = $status;
        $data['message'] = $message;
        echo json_encode($data);
    }

    public function deleteAirport() {
        $_POST = getJsonParam();
        extract($_POST);
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "airportinfo";
            $where = "id in ($ids) and type = '$type'";
            $o = $this->Commonmodel->delete_data($table, $where);
            if ($o) {
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        echo json_encode($data);
    }

    public function addEditAirport() {
        $table = "airportinfo";
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        extract($_POST);
        $rules['name'] = array('name', 'required');
        $rules['description'] = array('description', 'required');
        
        $this->Commonmodel->setFormsValidation($rules);
        $fv = $this->form_validation->run();
        $dbdata = array();
        $im = "Please upload a image";
        if (!empty($id)) {
            $im = 0;
            $dbdata = $this->Commonmodel->get_single_data($table, "id = '$id'", "*");
        }
        if ($fv) {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $imagename = time() . $_FILES['image']['name'];
                $data['im'] = $im = $this->Commonmodel->uploadFile2('image', AIRPORT_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = AIRPORT_IMAGES_THUMB, $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im === 1) {
                    $info['image'] = $imagename;
                }
            }
            $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
        }
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
            $info['slug'] = just_clean($info['name']);
            $info['description'] = htmlentities($info['description']);
            if (empty($id)) {
                $this->Commonmodel->save_data($table, $info);
                $msg = "Record successfully saved";
            } else {
                $this->Commonmodel->update_data($table, $info, "id = '$id'");
                $msg = "Record successfully updated";
            }

            $data['message'] = $msg;
        } else {
            $data['status'] = 201;
            $data['message'] = strip_tags(validation_errors());
        }
        echo json_encode($data);
    }

    public function qaTitles() {
        $_POST = getJsonParam();
        $table = "qatitles";
        $data = array();
        extract($_POST);

        $where = "id != ''";

//        $start = ($page - 1) * $limit;
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function addEditQaTitle() {
        $_POST = getJsonParam();
        $table = 'qatitles';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $info = $_POST;
        $r = 0;
        $id = "";
        extract($_POST);
        if ($name && !empty($name)) {
            $r = $this->Commonmodel->get_count($table, "name = '$name' and id != '$id'");
        }
        $rules['name'] = array('name', 'required|callback_checkExists[' . $r . '|This name is already exists]');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
            if (empty($id)) {
                $this->Commonmodel->save_data($table, $info);
                $msg = "Record successfully saved";
            } else {
                $this->Commonmodel->update_data($table, $info, "id = '$id'");
                $msg = "Record successfully updated";
            }

            $data['message'] = $msg;
        } else {
            $data['status'] = 201;
            $data['message'] = strip_tags(validation_errors());
        }
        echo json_encode($data);
    }

    public function deleteQaTitle() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "qatitles";
            $where = "id in ($ids)";
            $o = $this->Commonmodel->delete_data($table, $where);
            if ($o) {
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        echo json_encode($data);
    }

    public function getQaTitle() {
        $_POST = getJsonParam();
        $id = "";
        $slug = "";
        $status = 201;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($_POST);
            if (!empty($qaId) || !empty($slug)) {
                $table = "qatitles";
                $data = array();
                $where = "id = '$qaId'";
                $fields = "*";
                $dbData = $this->Commonmodel->get_single_data($table, $where, $fields);
                $data['data'] = $dbData;
                $status = 200;
            } else {
                $message = ERROR_PARAMS;
            }
        } else {
            $message = ERROR_RESPONSE;
        }
        $data['status'] = $status;
        $data['message'] = $message;
        echo json_encode($data);
    }

    public function qa() {
        $_POST = getJsonParam();
        if ($_POST) {
            extract($_POST);
            $table = "qa";
            $data = array();

            $where = "id != '' and qaId = '$qaId'";
            $lim = array();
            $fields = "*,concat('" . site_url(QA_IMAGES_THUMB) . "/',image) as image";
            $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
            foreach ($dbData as $a => $air) {
                $dbData[$a]['description'] = html_entity_decode($air['description']);
            }
            $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
            $data['dataList'] = $dbData;
            $data['status'] = 200;
            $data['message'] = "";
        } else {
            $data['status'] = 201;
        }
        echo json_encode($data);
    }

    public function deleteQa() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "qa";
            $where = "id in ($ids)";
            $o = $this->Commonmodel->delete_data($table, $where);
            if ($o) {
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        echo json_encode($data);
    }

    public function addEditQa() {
        $table = 'qa';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $info = $_POST;
        extract($_POST);
        $rules['name'] = array('name', 'required');
        $rules['description'] = array('description', 'required');
        
        $this->Commonmodel->setFormsValidation($rules);
        $fv = $this->form_validation->run();
        $dbdata = array();
        $im = "Please upload a image";
        if (!empty($id)) {
            $im = 0;
            $dbdata = $this->Commonmodel->get_single_data($table, "id = '$id'", "*");
        }
        if ($fv) {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $imagename = time() . $_FILES['image']['name'];
                $data['im'] = $im = $this->Commonmodel->uploadFile2('image', QA_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = QA_IMAGES_THUMB, $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im === 1) {
                    $info['image'] = $imagename;
                }
                $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
            }
        }
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
            $info['slug'] = just_clean($info['name']);
            $info['description'] = htmlentities($info['description']);
            if (empty($id)) {
                $this->Commonmodel->save_data($table, $info);
                $msg = "Record successfully saved";
            } else {
                $this->Commonmodel->update_data($table, $info, "id = '$id'");
                $msg = "Record successfully updated";
            }

            $data['message'] = $msg;
        } else {
            $data['status'] = 201;
            $data['message'] = strip_tags(validation_errors());
        }
        echo json_encode($data);
    }

}

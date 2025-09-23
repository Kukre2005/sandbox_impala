<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MIK_Controller {

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
        $_POST = getJsonParam();
        $table = "activities";
        $data = array();

        $where = "id != '0'";
        $lim = array();
        $fields = "*,concat('" . site_url(ACTIVITY_IMAGES_THUMB) . "/',image) as image";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);

        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function subActivity() {
        $_POST = getJsonParam();
        $status = 201;
        $message = "";
        $dbData = array();
        if ($_POST && count($_POST) > 0) {
            extract($_POST);
            if (!empty($actId)) {
                $table = "subactivities";
                $data = array();

                $where = "actId = '$actId'";
                $lim = array();
                $fields = "*,concat('" . site_url(ACTIVITY_IMAGES_THUMB) . "/',image) as image";
                $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
                foreach ($dbData as $a => $air) {
                    $dbData[$a]['description'] = html_entity_decode($air['description']);
                }
                $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
                $data['dataList'] = $dbData;
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function getActivity() {
        $_POST = getJsonParam();
        $id = "";
        $slug = "";
        $status = 201;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($_POST);
            if (!empty($actId) || !empty($slug)) {
                $table = "activities";
                $data = array();
                $where = "id = '$actId' or slug = '$slug'";
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

    public function deleteActivity() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "activities";
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

    public function deleteSubActivity() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "subactivities";
            $where = "id in ($ids)";
            $dbdata = $this->Commonmodel->get_data($table, $where, "image");
            $o = $this->Commonmodel->delete_data($table, $where);
            $data['q'] = $this->db->last_query();
            if ($o) {
                if (count($dbdata) > 0) {
                    $images = array_column($dbdata, "image");
                    unlink_files2(ACTIVITY_IMAGES_ORIGINAL, ACTIVITY_IMAGES_THUMB, $images);
                }
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        $data['data'] = array();
        echo json_encode($data);
    }

    public function addEditActivity() {
        $table = 'activities';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        $data['files']=$_FILES;
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
                $data['im'] = $im = $this->Commonmodel->uploadFile2('image', ACTIVITY_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = ACTIVITY_IMAGES_THUMB, $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
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

    public function addEditSubActivity() {
//        $_POST = getJsonParam();
        $table = 'subactivities';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        $data['files'] = $_FILES;
        extract($_POST);
        $info = $_POST;
        
        $rules['name'] = array('name', 'required');
        $rules['description'] = array('description', 'required');
        $rules['website'] = array('website', 'required|valid_url');
        $rules['phone'] = array('phone', 'required');
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
                $data['im'] = $im = $this->Commonmodel->uploadFile2('image', ACTIVITY_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = ACTIVITY_IMAGES_THUMB, $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im === 1) {
                    $info['image'] = $imagename;
                }
            }
            $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
        }
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

}

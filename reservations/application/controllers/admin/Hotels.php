<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels extends MIK_Controller {

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
        $table = "hotels";
        $data = array();
        extract($_POST);

        $where = "id != ''";

//        $start = ($page - 1) * $limit;
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        // foreach($dbData as $i=>$d)
        // {
        //     $code = "BH0".$i;
        //     $this->Commonmodel->update_data($table,array("code"=>$code),"id = '".$d['id']."'");
        // }
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        //$data['q'] = $this->db->last_query();
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function getGroupHotels() {
        $_POST = getJsonParam();
        $table = "hotels";
        $data = array();
        $groupId = '';
        extract($_POST);

        
        // $where = "!find_in_set(id,(select case when group_concat(hotels SEPARATOR ',') IS NOT NULL then group_concat(hotels SEPARATOR ',') else '0' end as hotels from hotelgroups where id != '$groupId' and type = '$type'))";
        $where = "id != ''";
//        $start = ($page - 1) * $limit;
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        $dbGrupCodes = $this->Commonmodel->get_data("hotelgroups", $where." and type = '$type'", $fields, "");
        $data['dataList'] = $dbData;
        $existcodes = array();
        foreach($dbGrupCodes as $c=>$d)
        {
            $codedata = explode(",",$d['name']);
            $existcodes = array_merge($existcodes,$codedata);
        }
        $codes = array();
        foreach($dbData as $c=>$d)
        {
            $codedata = explode(",",$d['code']);
            $codes = array_merge($codes,$codedata);
        }
        if(count($existcodes)>0)
        {
            $codes = array_diff($codes,$existcodes);
        }
        $data['codes'] = $codes;
        //$data['q'] = $this->db->last_query();
        echo json_encode($data);
    }

    public function getGroups() {
        $_POST = getJsonParam();
        $table = "hotelgroups";
        $data = array();
        extract($_POST);

        $where = "id != '' and type='$type'";

//        $start = ($page - 1) * $limit;
        $lim = array();
        $fields = "*,(select group_concat(name) from hotels where find_in_set(id,hotelgroups.hotels)) as hotelNames";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        //$data['q'] = $this->db->last_query();
        $data['dataList'] = $dbData;
        
        echo json_encode($data);
    }

    public function deleteHotel() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "hotels";
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

    public function addEditGroup() {
        $_POST = getJsonParam();
        $table = 'hotelgroups';
        $info = array();
        $id="";
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $info = $_POST;
        extract($_POST);

        $r = 0;
        if (!empty($name)) {
            $data['r'] = $r = $this->Commonmodel->get_count($table, "id != '$id' and name = '$name' and type = '$type'");
        }
        $rules['name'] = array('name', "required|callback_checkExists[$r|This name is already exists]");
        $rules['cost_one_way_1_5'] = array('cost one way 1-5', 'required');
        // $rules['cost_round_trip_1_5'] = array('cost round trip 1-5', 'required');
        if ($type == 'private_transport') {
            // $rules['cost_one_way_6_10'] = array('cost one way 6-10', 'required');
            // $rules['cost_round_trip_6_10'] = array('cost round trip 6-10', 'required');
            // $rules['cost_one_way_11_15'] = array('cost one way 11-15', 'required');
            // $rules['cost_round_trip_11_15'] = array('cost round trip 11-15', 'required');
        }
        $rules['hotels[]'] = array('hotels', 'required');

        $this->Commonmodel->setFormsValidation($rules);
        
        if ($this->form_validation->run() == true) {
            $info['hotels'] = implode(",",$hotels);
            unset($info['hotelNames']);
            if (empty($id)) {
                $id = $this->Commonmodel->save_data($table, $info);
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

    public function deleteGroup() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "hotelgroups";
            $where = "id in ($ids) and type='$type'";
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

    public function addEditHotel() {
        $_POST = getJsonParam();
        $table = 'hotels';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $info = $_POST;
        $r = 0;
        $id = "";
        $codes = array();
        extract($_POST);

        if ($name && !empty($name)) {
            $r = $this->Commonmodel->get_count($table, "name = '$name' and id != '$id'");
        }
        if ($code && !empty($code)) {
            $codes = explode(",",$code);
            $r2 = $this->Commonmodel->get_count($table, "code like '%$code%' and id != '$id'");
        }
        $rules['name'] = array('name', 'required|callback_checkExists[' . $r . '|This name is already exists]');
        $rules['name'] = array('code', 'required|callback_checkExists[' . $r2 . '|A hotel code is already exists]');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
            $code = implode(",",$codes);
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

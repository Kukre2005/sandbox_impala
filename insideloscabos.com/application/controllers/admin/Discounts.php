<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Discounts extends MIK_Controller {

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
        $table = "discount";
        $data = array();
        extract($_POST);
        
        $where = "id != '' and type='$type'";

//        $start = ($page - 1) * $limit;
        $lim = array();
        $fields = "*,TIME_FORMAT(fromTime, '%h:%i %p') as fromTime,TIME_FORMAT(toTime, '%h:%i %p') as toTime";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['q'] = $this->db->last_query();
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function getFestiveDiscounts() {
        $_POST = getJsonParam();
        $table = "coupons";
        $data = array();
        extract($_POST);
        $where = "";
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim, "id desc");
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['q'] = $this->db->last_query();
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

   
    public function deleteDiscount() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "discount";
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

    public function addEditDiscount() {
        $_POST = getJsonParam();
        $table = 'discount';
        $info = array();
        $id = '';
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        extract($_POST);
        
        $r=0;
        $info['fromTime'] = date("H:i", strtotime($info['fromTime']));
            $info['toTime'] = date("H:i", strtotime($info['toTime']));
            
        if(!empty($toTime) && !empty($fromTime))
        {
            $r = $this->Commonmodel->get_count($table,"day = '$day' and id != '$id' and type = '".$type."' and ('".$info['fromTime']."' between fromTime and toTime or '".$info['toTime']."' between fromTime and toTime)");
//            $data['qq']=$this->db->last_query();
        }
        $rules['day'] = array('day', 'required');
        $rules['fromTime'] = array('from time', 'required');
        $rules['toTime'] = array('to time', 'required|callback_checkExists['.$r.'|The time with this day is already added]');
        $rules['discount'] = array('discount', 'required|numeric');
        
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
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

    public function addEditFestiveContent() {
        $description = $_POST['description'];
        $table = 'discount_content';
        $info = array();
        $id = '';
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        // $data['postData'] = $info = $_POST;
        $rules['description'] = array('description', 'required');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
            $isExist = $this->Commonmodel->get_single_data($table);
            $info['description'] = $description;
            $info['added_date'] = date('Y-m-d H:i:s');
            if(empty($isExist)){
                $id = $this->Commonmodel->save_data($table, $info);
                $msg = "Record successfully saved";
            }else{
                $id = $isExist['id'];
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

    public function getFestiveDiscountContent()
    {
        $_POST = getJsonParam();
        $table = "discount_content";
        $data = array();
        extract($_POST);
        $where = "";
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_single_data($table);
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function updateSliderCoupon()
    {
        $_POST = getJsonParam();
        $table = "coupons";
        $data = array();
        $message = "";
        $status = 200;
        extract($_POST);
        $value = $_POST['value'];
        $dbData = $this->Commonmodel->update_data($table,array('is_slider2_coupon' => 0),array('id !=' => $value));
        $dbData = $this->Commonmodel->update_data($table,array('is_slider2_coupon' => 1),array('id' => $value));
        $data['message'] = $message;
        $data['status'] = $status;
        echo json_encode($data);
    }

    /**
        * [To upload files using core php]
        * @param  [string] $name
        * @param  [string] $subfolder
    */
    public function corefileUploading($name,$subfolder){    
      $f_name1 = $_FILES[$name]['name'];    
      $f_tmp1  = $_FILES[$name]['tmp_name'];    
      $f_size1 = $_FILES[$name]['size'];    
      $f_extension1 = explode('.',$f_name1);     
      $f_extension1 = strtolower(end($f_extension1));    
      $f_newfile1="";    
      if($f_name1){      
        $f_newfile1 = uniqid().time().'.'.$f_extension1;      
        $store1 = "uploads/".$subfolder."/". urlencode($f_newfile1);     
        if(move_uploaded_file($f_tmp1,$store1)){        
          chmod($store1, 0777);       
          return $store1;     
        }else{       
          return "";      
        }
      }else{
        return "";    
      }    
    }

    public function addEditFestiveDiscount()
    {
        $table = 'coupons';
        $info = array();
        $id = '';
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        extract($_POST);
        $dateArr = explode(" - ", $info['date_range']);
        $info['start_date'] = $dateArr[0];
        $info['end_date']   = $dateArr[1];
        $info['added_date'] = date('Y-m-d H:i:s');
        
        if(!empty($_FILES['image']))
        {
            $info['discount_image'] = $this->corefileUploading('image','coupons');
        }
        unset($info['date_range']);
        unset($info['image']);
        $r=0;
        $rules['coupon_type'] = array('coupon type', 'required|in_list[0,1]');
        // $rules['coupon_code'] = array('coupon code', 'required|exact_length[6]|is_unique[coupons.coupon_code]');
        $rules['coupon_code'] = array('coupon code', 'required|exact_length[6]');
        if($_POST['coupon_type'] == 0){
            $rules['coupon_amount'] = array('coupon amount', 'required|numeric'); // fixed
        }else{
            $rules['coupon_amount'] = array('coupon amount', 'required|numeric'); // percent
        }
        $this->form_validation->set_message('is_unique', 'Coupon code already exist');
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
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

    public function deleteFestiveDiscount() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "coupons";
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


}

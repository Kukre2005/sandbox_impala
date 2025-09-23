<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MIK_Controller {

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
        $type="private_transport";
        $orderby="createdAt desc";
        $_POST = getJsonParam();
        $table = "booking";
        
        $data = array();
        extract($this->input->post());
        extract($pagination);
        $where = "id != '' and type = '$type'";
        if (count($search) > 0) {
            extract($search['predicateObject']);
            if (isset($bookingId)) {
                $where.=" and bookingId = '$bookingId'";
            }
            if (isset($email)) {
                $where.=" and email = '$email'";
            }
            if (isset($bookStatus)) {
                $where.=" and bookStatus = '$bookStatus'";
            }

            if (isset($payStatus)) {
                $where.=" and payStatus = '$payStatus'";
            }

            if (isset($name)) {
                $where.="and name like '$name' or name like '%$name%'";
            }
            if (isset($hotelId)) {
                $where.="and hotelId = '$hotelId'";
            }
        }
//        $start = $start+1;
//        $start2 = ($start - 1) * $number;
        $lim = array('start' => $start, 'limit' => $number);
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y') as bookDate,DATE_FORMAT(arrivalDate,'%d/%m/%Y %h:%i %p') as arrivalDate,DATE_FORMAT(departureDate,'%d/%m/%Y %h:%i %p') as departureDate,(select name from hotels where hotels.id = booking.hotelId) as hotelName";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, $orderby, $lim);
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbBook;
        $data['totalPages'] = ceil($total / $number);
        echo json_encode($data);
    }

    public function deleteBooking() {
        $type="private_transport";
        $_POST = getJsonParam();
        extract($_POST);
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "booking";
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

    public function getContact() {
        $_POST = getJsonParam();
        $table = "contact";
        $data = array();
        extract($this->input->post());
        extract($pagination);
        $where = "id != ''";
        if (count($search) > 0) {
            extract($search['predicateObject']);
            if (isset($service)) {
                $where.=" and service = '$service'";
            }
            if (isset($email)) {
                $where.=" and email = '$email'";
            }
            if (isset($phone)) {
                $where.=" and phone = '$phone'";
            }

           

            if (isset($name)) {
                $where.="and name like '$name' or name like '%$name%'";
            }
            if (isset($hotelId)) {
                $where.="and hotelId = '$hotelId'";
            }
        }
//        $start = $start+1;
//        $start2 = ($start - 1) * $number;
        $lim = array('start' => $start, 'limit' => $number);
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y') as contactDate,(select name from hotels where hotels.id = contact.hotelId) as hotelName";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, "", $lim,"createdAt desc");
        $data['q'] = $this->db->last_query();
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbBook;
        $data['totalPages'] = ceil($total / $number);
        echo json_encode($data);
    }

    public function deleteContact() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "contact";
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


     public function getCoupons() {
        $_POST = getJsonParam();
        $table = "coupon";
        $data = array();

        $where = "id != ''";
        $lim = array();
        $fields = "*";
        $dbData = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
        $data['q'] = $this->db->last_query();
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbData;
        echo json_encode($data);
    }

    public function deleteCoupons() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "coupon";
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

    
    
    public function addEditCoupon() {
         $_POST = getJsonParam();
         $id="";
         extract($_POST);
        $table = 'coupon';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $info=$_POST;
        $r=0;
        if(!empty($code))
        {
            $r=$this->Commonmodel->get_count($table,"code = '$code' and id != '$id'");
        }
        $rules['code'] = array('coupon code', 'required|callback_checkExists['.$r.'|This coupon code is already exists]');
        $rules['discountCost'] = array('discount cost', 'required|numeric');
        
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

 
     public function getQuote() {
        $_POST = getJsonParam();
        $table = "quotes";
        $data = array();
        extract($this->input->post());
        extract($pagination);
        $where = "id != ''";
        if (count($search) > 0) {
            extract($search['predicateObject']);
            if (isset($service)) {
                $where.=" and service = '$service'";
            }
            if (isset($actId)) {
                $where.=" and actId = '$actId'";
            }
            if (isset($email)) {
                $where.=" and email = '$email'";
            }
            if (isset($phone)) {
                $where.=" and phone = '$phone'";
            }
            if (isset($reservationDate)) {
                $where.=" and reservationDate = '".date('Y-m-d',  strtotime($reservationDate))."'";
            }

           

            if (isset($name)) {
                $where.="and name like '$name' or name like '%$name%'";
            }
            if (isset($hotelId)) {
                $where.="and hotelId = '$hotelId'";
            }
            
        }
//        $start = $start+1;
//        $start2 = ($start - 1) * $number;
        $lim = array('start' => $start, 'limit' => $number);
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y') as quoteDate,DATE_FORMAT(reservationDate,'%d/%m/%Y') as reservationDate,(select name from hotels where hotels.id = quotes.hotelId) as hotelName,(select name from activities where activities.id = quotes.actId) as actName";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, "", $lim,"createdAt desc");
        $data['q'] = $this->db->last_query();
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbBook;
        $data['totalPages'] = ceil($total / $number);
        echo json_encode($data);
    }

    public function deleteQuote() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "quotes";
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->view('index');
	}
        
    public function adminIndex()
	{   
        $this->load->view('admin_view_new');
	}

	public function book_trip()
	{
	  $data = $this->input->post();	
	  $transportation_type = '';
	  if($data['transportation_type'] == 0){
	  	$transportation_type = 'private-transportation';
	  }else{
	  	$transportation_type = 'cabo-shuttle';
	  }
	  redirect(base_url().$transportation_type.'?'.http_build_query($data));
	}

	public function checkCouponCode()
    {
        $couponCode = @trim($this->input->post('coupon_code'));
        $transportationType = $this->input->post('transportationType');
        $query = $this->db->query('SELECT * FROM `coupons` WHERE `transportation_type` = '.$transportationType.' AND `coupon_code` = "'.$couponCode.'"');
        $coupon_details = $query->result_array();
        if(!empty($coupon_details)){
        	if(strtotime(date('Y-m-d')) <= strtotime($coupon_details[0]['end_date'])){
        		$coupon_type   = $coupon_details[0]['coupon_type'];
        		$coupon_amount = $coupon_details[0]['coupon_amount'];
        		echo json_encode(array('type' => 1, 'msg' => 'Coupon applied successfully','coupon_type' => $coupon_type, 'coupon_amount' => $coupon_amount));exit;
        	}else{
        		echo json_encode(array('type' => 0, 'msg' => 'Coupon code has expired'));exit;
        	}
        }else{
        	echo json_encode(array('type' => 0, 'msg' => 'Invalid coupon code'));exit;
        }
    }

}

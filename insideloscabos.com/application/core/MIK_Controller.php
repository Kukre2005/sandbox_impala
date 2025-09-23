<?php



class MIK_Controller extends CI_Controller {



    public $tabname = array();

    public $pval = array();

    public $dbAct = array();



    function __construct() {

        parent::__construct();

        $data = array();

        $curl = current_url();

        if (strpos($curl, '/admin/') !== false) {

            if (strpos($curl, 'auth/login') == false && strpos($curl, 'auth/forgotPassword') == false) {

                if (!$this->session->userdata("loginData")) {

                    $data=array("data"=>$this->session,"status"=>201,"message"=>"Invalid request");

                    echo json_encode($data);

                    exit;

                }

            }

        } else {

            $data['dbAct'] = $this->getActivities();

            $data['dbSocial'] = $this->getSocial();
			$slug = $this->uri->segment(1);
			if($this->uri->segment(2) !=''){
				$slug .= '/'.$this->uri->segment(2);
			}
			if($slug != ''){
				$dbMeta = $this->getMetaContent($slug);
				if(empty($dbMeta)){
					$dbMeta = $this->getMetaContent();
				}
			}else{
				$dbMeta = $this->getMetaContent();
			}
            

            $data = array_merge($data, $dbMeta);

            //Load variables in all views
			//echo $this->uri->segment(1)."<pre>"; print_R($data); die;
            

            $this->load->vars($data);

        }

    }



    function getMetaContent($pageSlug = 'home') {

        $table = "metacontent";

        $dbMeta = $this->Commonmodel->get_single_data($table, "pageSlug = '$pageSlug'", "metaTitle,metaContent,metaKeywords");

        return $dbMeta;

    }



    function getActivities() {

        $dbAct = $this->Commonmodel->get_data("activities", "status = '1'", "slug,name,id");

        return $dbAct;

    }



        function getSocial() {

        $dbAct = $this->Commonmodel->get_single_data("sociallinks", "id != ''", "*");

        return $dbAct;

    }



    function editor($path, $width) {

        //Loading Library For Ckeditor

        $this->load->library('ckeditor');

        $this->load->library('ckFinder');

        //configure base path of ckeditor folder 

        $this->ckeditor->basePath = base_url() . 'js/ckeditor/';

        $this->ckeditor->config['toolbar'] = 'Full';

        $this->ckeditor->config['language'] = 'en';

        $this->ckeditor->config['width'] = $width;

        //configure ckfinder with ckeditor config 

        $this->ckfinder->SetupCKEditor($this->ckeditor, $path);

    }



    function setmsg($msg, $field = 'msg') {

        $this->session->set_flashdata($field, $msg);

    }



    public function checkExists($field, $recordCountWithMessage) {

        //echo "<script>alert('hii')</script>";



        $recordCountM = explode("|", $recordCountWithMessage);

        $recordCount = $recordCountM[0];

        $msg = $recordCountM[1];

        if ($recordCount == '0') {

            return TRUE;

        } else {



            $this->form_validation->set_message('checkExists', $msg);

            return FALSE;

        }

    }



    public function checkNotExists($field, $recordCountWithMessage) {

        //echo "<script>alert('hii')</script>";



        $recordCountM = explode("|", $recordCountWithMessage);

        $recordCount = $recordCountM[0];

        $msg = $recordCountM[1];

        if ($recordCount > 0) {

            return TRUE;

        } else {



            $this->form_validation->set_message('checkNotExists', $msg);

            return FALSE;

        }

    }



    public function handleFileUpload($field, $recordCount) {

        //echo "<script>alert('hii')</script>";

        

        if (is_numeric($recordCount)) {

            return TRUE;

        } else {



            $this->form_validation->set_message('handleFileUpload', $recordCount);

            return FALSE;

        }

    }



    public function get_paging($burl, $count, $per_page) {

        $this->load->library('pagination');



        $config['base_url'] = $burl;

        //$count=100;

        $config['total_rows'] = $count;

        $config['use_page_numbers'] = TRUE;

        $config['per_page'] = $per_page;

        $config['full_tag_open'] = '<div class="pagination"><ul class="">';

        $config['full_tag_close'] = '</ul></div>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';



        $config['anchor_class'] = 'follow_link';

        //print_r($config);

        $this->pagination->initialize($config);

        return $this->pagination->create_links();

    }



    function insertlog($data = array('table' => '', 'action' => '', 'module' => '', 'olddata' => '', 'newdata' => '')) {

        $data['adminid'] = $this->session->userdata('admin_user_id');

        $data['logdate'] = date('Y-m-d H:i:s');

        $data['ip'] = $this->input->ip_address();

        $this->common->save_data('logs', $data);

    }



    function deletedata($table, $ids) {



        if (count($ids) > 0) {

            $this->common->delete_data_by($table, 'id', $ids);

            $this->session->set_flashdata('msg', 'Record deleted successfully');

            redirect($u);

        } else {

            $data['errormsg'] = "Please select records to delete";

        }

    }



    public function sendemail($email, $subject, $message, $from_email, $attachment = '') {

        // Get full html:

        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>

        <style type="text/css">

            body {

                font-family: Arial, Verdana, Helvetica, sans-serif;

                font-size: 16px;

            }

        </style>

    </head>

    <body>

    ' . $message . '

    </body>

    </html>';

        // Also, for getting full html you may use the following internal method:

        //$body = $this->email->full_html($subject, $message);



        $this->email

                ->from($from_email)

                ->reply_to($from_email)    // Optional, an account where a human being reads.

                ->to($email)

                ->subject($subject)

                ->message($body);

        if (!empty($attachment) && file_exists($attachment)) {

            $this->email->attach($attachment);

        }

        $result = $this->email->send();

        //    $res[]

        //var_dump($message);

        //echo '<br />';

        //echo $this->email->print_debugger();

        //exit;

        return $result;

    }



}



?>
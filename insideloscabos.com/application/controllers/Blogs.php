<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends MIK_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index($page = "1") {
        $data = array();
        $search="";
        $tag="";
        extract($this->input->get());
        if (is_numeric($page)) {

            $this->load->library('pagination');
            
            $limit = 2;
            $table = "blogs";
            $whereRec = $where = "blogs.status = '1'";
            if((isset($search) && !empty($search)))
            {
                $where.=" and (blogs.name = '$search' or blogs.name like '%$search%' or blogs.shortDesc like '%$search%')";
            }
            if((isset($tag) && !empty($tag)))
            {
                $where.=" and find_in_set('$tag',tags)";
            }
            $start = ($page - 1) * $limit;
            $limArr = array("start" => $start, "limit" => $limit);
            $limArr2 = array("start" => $start, "limit" => 5);
            $fields = "blogs.*,createdAt,concat('" . site_url(BLOG_IMAGES_ORIGINAL) . "/',blogs.image) as image,concat('" . site_url(USER_IMAGES_THUMB) . "/',admin.image) as authorImage";
            $dbRecBlogs = $this->Commonmodel->get_join_data($table, array(array('name' => 'admin', 'on' => 'admin.id = blogs.authorId')), $whereRec, $fields, "blogs.createdAt desc", $limArr2);
            $dbBlogs = $this->Commonmodel->get_join_data($table, array(array('name' => 'admin', 'on' => 'admin.id = blogs.authorId')), $where, $fields, "blogs.createdAt desc", $limArr);
            
            $count = $this->Commonmodel->get_count($table, $where);
            $dbTags = $this->Commonmodel->get_single_data($table,"status = '1'","group_concat(tags) as tags");
            $tagsArr=array();
            $tagsArr = explode(',',$dbTags['tags']);
            $tagsArr = array_unique($tagsArr);
            $data['tagsArr'] = $tagsArr;
            
            $data['mo'] = "blog";
            $data['dbBlogs'] = $dbBlogs;
            $data['dbRecBlogs'] = $dbRecBlogs;
            $config['base_url'] = site_url("blogs");

            $config['total_rows'] = $count;
            $config['per_page'] = $limit;
            $config['suffix'] = '?'.http_build_query($_GET, '', "&");
            $config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_link'] = ' Next <i class="fa fa-angle-right"></i> <span class="sr-only">Next</span>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i> Prev<span class="sr-only">Previous</span>';
            $config['prev_tag_close'] = '</li>';

            $config['first_tag_open'] = '<li class="page-item disabled">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</a></li>';
            $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);
            $data['page'] = $page;
            $data['pagination'] = $this->pagination->create_links();
            
            $data['search']=$search;    
            $this->load->view('index', $data);
        } else {
            $this->blogDetail($page);
        }
    }

    public function blogDetail($blogSlug) {
        $data = array();
        $data['mo'] = "blog-detail";
        $table = "blogs";
        $where = "blogs.slug = '$blogSlug'";
        $fields = "blogs.*,createdAt,concat('" . site_url(BLOG_IMAGES_ORIGINAL) . "/',blogs.image) as image,concat('" . site_url(USER_IMAGES_THUMB) . "/',admin.image) as authorImage,admin.description as authorDesc";
        $dbBlogs = $this->Commonmodel->get_join_data($table, array(array('name' => 'admin', 'on' => 'admin.id = blogs.authorId')), $where, $fields);
        $dbBlog = $dbBlogs[0];
        $data['metaTitle'] = $dbBlog['name'];
        $data['metaContent'] = $dbBlog['shortDesc'];
        $data['metaKeywords'] = $dbBlog['shortDesc'];
        $data['dbBlog'] = $dbBlog;
        $tags = $dbBlog['tags'];
        $tagsArr = explode(",",$tags);
        $where2="id != ''";
        if(count($tagsArr)>0)
        {
            foreach($tagsArr as $t=>$tagsData)
            {
                $where2 .=($t == 0)?" and (tags like '%$tagsData%'":" or tags like '%$tagsData%'";
            }
            $where2.=")";
        }
        $dbRelBlog = $this->Commonmodel->get_data($table,$where2,"slug,name,concat('" . site_url(BLOG_IMAGES_ORIGINAL) . "/',blogs.image) as image","createdAt desc",array('start'=>'0','limit'=>'4'));
        $data['dbRelBlog']=$dbRelBlog;
        $this->load->view('index', $data);
    }

    public function sendFriend() {
        $data=array();
        $this->load->model("Email_model");
        $status="200";
        $message="";
        if ($_POST) {
            extract($_POST);
            if (isset($email) & isset($blogId)) {
                $table = "blogs";
                $where = "blogs.id = '$blogId'";
                $fields = "blogs.*,DATE_FORMAT(NOW(),'%b %d, %y') as blogDate,concat('" . site_url(BLOG_IMAGES_ORIGINAL) . "/',blogs.image) as image,concat('" . site_url(USER_IMAGES_THUMB) . "/',admin.image) as authorImage,admin.description as authorDesc";
                $dbBlogs = $this->Commonmodel->get_join_data($table, array(array('name' => 'admin', 'on' => 'admin.id = blogs.authorId')), $where, $fields);
                $dbBlog = $dbBlogs[0];
                extract($dbBlog);
                $to = $email;
                $blogurl = site_url('blog/'.$slug);
                $subject = "Your friend sent you an blog from " . SITE_NAME . ".";
                $msgBody = '<html><body>';
                $msgBody .= '<img src="'.site_url('assets/img/logo.png').'" alt="Insideloscabos" />';
                $msgBody .= "<div><img src='".$image."'></div>";
                $msgBody .= "<div><a href='$blogurl'>".$name."</a></div>";
                $msgBody .= "<div>By <a href='".  site_url()."'>".SITE_NAME."</a> on $blogDate</div>";
                $msgBody .= "<div>".  html_entity_decode($shortDesc)."..<a href='$blogurl'>Read More</a></div>";
                $msgBody .= '<div>Regards,<br>';
                $msgBody .= "<strong>" . SITE_NAME . "</strong><br>";
                $msgBody .= '<img src="' . site_url('assets/img/newlogo.png') . '" alt="Insideloscabos" />';
                $msgBody .= "</body></html>";
                $o = $this->Email_model->sendEmail($to, $subject, $msgBody, "", FROM_EMAIL, FROM_NAME);
                if($o == true)
                {
                    $status ="200";
                    $message = "Mail sent successfully.";
                }else{
                    $message = "Error occurred during sending mail.Please try again.";
                    $status = "201";
                }
            }else{
                $status = "201";
                $message="Invalid Params";
            }
        }else{
            $status = "201";
            $message="Invalid Params";
        }
        $data['status']=$status;
        $data['message']=$message;
        
        echo json_encode($data);
    }

    public function saveComment() {
//        $_POST = getJsonParam();
        if ($_POST && count($_POST) > 0) {
            $table = 'blogscomments';
            $info = array();
            $data = array('status' => 200, 'message' => '', 'responseData' => array());
            $data['postData'] = $info = $this->input->post();
            extract($this->input->post());
            $rules['fullName'] = array('full name', 'required');
            $rules['email'] = array('email', 'required|valid_email');
            $rules['message'] = array('message', 'required');

            $rules['website'] = array('website', 'required');
            $this->Commonmodel->setFormsValidation($rules);
            if ($this->form_validation->run() == true) {

                if (empty($id)) {
                    $info['createdAt'] = date("Y-m-d H:i:s");
                    $this->Commonmodel->save_data($table, $info);
                    $msg = "Dear user,your comment has been submitted successfully.Thank you";
                } else {
                    $info['modifiedAt'] = date("Y-m-d H:i:s");
                    $this->Commonmodel->update_data($table, $info, "id = '$id'");
                    $msg = "Record successfully updated";
                }

                $data['message'] = $msg;
            } else {
                $data['status'] = 201;
                $data['message'] = strip_tags(validation_errors());
            }
        } else {
            $data['status'] = 201;
            $data['message'] = "Params are missing or invalid";
        }
        echo json_encode($data);
    }
    
    

    public function loadComments() {
//        $_POST = getJsonParam();
        $status = "200";
        $message = "";
        if ($_POST && count($_POST) > 0) {
            $limit = "5";
            $table = 'blogscomments';
            $info = array();
            $data = array('status' => 200, 'message' => '', 'responseData' => array());
            $data['postData'] = $info = $_POST;
            $page = 1;
            extract($_POST);
            $dbComments = array();
            $rules['blogId'] = array('blog', 'required');
            $html = "";
            $this->Commonmodel->setFormsValidation($rules);
            if ($this->form_validation->run() == true) {

                $start = ($page - 1) * $limit;
                $limArr = array("start" => $start, "limit" => $limit);
                $dbComments = $this->Commonmodel->get_data($table, "blogId = '$blogId' and status = '1'", "*", "createdAt desc", $limArr);
                $data['dbComments'] = $dbComments;
                $data['page']=$page;
                $html = $this->load->view('module/ajaxComments', $data, true);
                $data['count']=count($dbComments);
            } else {
                $status = 201;
                $message = strip_tags(validation_errors());
            }
        } else {
            $status = 201;
            $message = "Params are missing or invalid";
        }
        $data['status'] = $status;
        $data['message'] = $message;
        $data['html'] = $html;
        //add the header here
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function offers()
    {
        if(IS_OFFER_HIDE == 'hidden') redirect('/');
       // redirect(DISCOUNT_DOMAIN_URL.'offers');
        $data = array();
        $data['mo'] = "offers";
        $query = $this->db->query('SELECT * FROM `coupons` WHERE `is_public` = 1 AND `end_date` >= CURDATE()');
        $data['coupons'] = $query->result_array();
        $data['discount_content'] = $this->Commonmodel->get_single_data('discount_content');
        $this->load->view('index',$data);
    }

    

    
    
}

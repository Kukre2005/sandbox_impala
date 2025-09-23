<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MIK_Controller {

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
        $table = "blogs";
        $data = array();
        extract($this->input->post());
        extract($pagination);
        $where = "id != ''";
        if (count($search) > 0) {
            extract($search['predicateObject']);
       
            if (isset($name)) {
                $where.="and name like '$name' or name like '%$name%'";
            }
        
        }
//        $start = $start+1;
//        $start2 = ($start - 1) * $number;
        $lim = array('start' => $start, 'limit' => $number);
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y %h:%i %p') as createdAt,concat('".site_url(BLOG_IMAGES_THUMB) . "/',image) as image";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
        $data['q'] = $this->db->last_query();
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbBook;
        $data['totalPages'] = ceil($total / $number);
        echo json_encode($data);
    }

   
    public function getBlog() {
        $_POST = getJsonParam();
        $id = "";
        $slug="";
        $status = 201;
        $message = "";
        if ($_POST && count($_POST) > 0) {
            extract($_POST);
            if (!empty($id) || !empty($slug)) {
                $table = "blogs";
                $data = array();
                $where = "id = '$id' or slug = '$slug'";
                $fields = "*,concat('".site_url(BLOG_IMAGES_THUMB) . "/',image) as image";
                $dbData = $this->Commonmodel->get_single_data($table, $where, $fields);
                $dbData['description'] = html_entity_decode($dbData['description']);
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

   
      public function deleteBlog() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "blogs";
            $where = "id in ($ids)";
            $dbdata=$this->Commonmodel->get_data($table,$where,"image");
            $o = $this->Commonmodel->delete_data($table, $where);
            $data['q']=$this->db->last_query();
            if ($o) {
                if(count($dbdata)>0)
                {
                    $images= array_column($dbdata,"image");
                    unlink_files2(BLOG_IMAGES_ORIGINAL,BLOG_IMAGES_THUMB,$images);
                }
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        $data['data']=array();
        echo json_encode($data);
    }

    
    public function addEditBlog() {
//        $_POST = getJsonParam();
        $table = 'blogs';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        $data['files'] = $_FILES;
        extract($_POST);
        $info=$_POST;
        
        $rules['name'] = array('name', 'required');
        $rules['shortDesc'] = array('short description', 'required');
        
        $rules['description'] = array('description', 'required');
//        $rules['author'] = array('author', 'required');
//        $rules['blogDate'] = array('blogDate', 'required');
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
                $im = $this->Commonmodel->uploadFile2('image', BLOG_IMAGES_ORIGINAL, 'jpg|png|gif', $imagename, $resize = true, $resize_path = BLOG_IMAGES_THUMB, $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im) {
                    $info['image'] = $imagename;
                }
            }
            $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
        }
        $this->Commonmodel->setFormsValidation($rules);
        if ($this->form_validation->run() == true) {
//            $info['blogDate']= date("Y-m-d",  strtotime($info['blogDate']));
            $info['slug']=  just_clean($info['name']);
            $info['description'] = htmlentities($info['description']);
            $uData = $this->session->userdata("loginData");
            $info['authorId']=$uData['id'];
            $info['author']=$uData['name'];
            if (empty($id)) {
                $info['createdAt']=date("Y-m-d H:i:s");
                $this->Commonmodel->save_data($table, $info);
                $msg = "Record successfully saved";
            } else {
                $info['modifiedAt']=date("Y-m-d H:i:s");
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

        public function getComments() {
       $_POST = getJsonParam();
        $table = "blogscomments";
        $data = array();
        extract($this->input->post());
        
        $where = "blogId = '$blogId'";
        $lim = array();
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y %h:%i %p') as createdAt";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
        $data['dataList'] = $dbBook;
        echo json_encode($data);
    }

    
    
      public function deleteComments() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "blogscomments";
            $where = "id in ($ids)";
            $o = $this->Commonmodel->delete_data($table, $where);
            $data['q']=$this->db->last_query();
            if ($o) {
            
                $status = 200;
                $message = "Records are deleted successfully";
            } else {
                $message = "Some error occurred during the process ";
            }
        }
        $data['message'] = $message;
        $data['status'] = $status;
        $data['data']=array();
        echo json_encode($data);
    }
    
    
    public function getSubscribe() {
        $_POST = getJsonParam();
        $table = "subscribe";
        $data = array();
        extract($this->input->post());
        extract($pagination);
        $where = "id != ''";
        if (count($search) > 0) {
            extract($search['predicateObject']);
            
            if (isset($email)) {
                $where.=" and email = '$email'";
            }
            
            if (isset($name)) {
                $where.="and name like '$name' or name like '%$name%'";
            }
            
        }
//        $start = $start+1;
//        $start2 = ($start - 1) * $number;
        $lim = array('start' => $start, 'limit' => $number);
        $fields = "*,DATE_FORMAT(createdAt,'%d/%m/%Y') as subscribeDate";
        $dbBook = $this->Commonmodel->get_data($table, $where, $fields, "", $lim,"createdAt desc");
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['dataList'] = $dbBook;
        $data['totalPages'] = ceil($total / $number);
        echo json_encode($data);
    }

    public function deleteSubscribe() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "subscribe";
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

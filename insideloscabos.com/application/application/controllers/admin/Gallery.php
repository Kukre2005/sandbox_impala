<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MIK_Controller {

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

    public function galleryInfo() {
        $_POST = getJsonParam();
        $table = "gallery";
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

   
    public function deleteGallery() {
        $_POST = getJsonParam();
        $data = array();
        $message = "";
        $status = 201;
        if (isset($_POST) && count($_POST) > 0 && isset($_POST['ids']) && count($_POST['ids']) > 0) {
            extract($this->input->post());
            $ids = implode(",", $this->input->post('ids'));
            $table = "gallery";
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

    /**
        * [To get user image thumb]
        * @param  [string] $filepath
        * @param  [string] $subfolder
        * @param  [int] $width
        * @param  [int] $height
        * @param  [int] $min_width
        * @param  [int] $min_height
    */
  public function get_image_thumb($filepath,$subfolder,$width,$height,$min_width="",$min_height="")
  {

    if(empty($min_width))
    {
      $min_width = $width;
    }
    if(empty($min_height))
    {
      $min_height = $height;
    }
    /* To get image sizes */
    $image_sizes = getimagesize($filepath);
    if(!empty($image_sizes))
    {
      $img_width  = $image_sizes[0];
      $img_height = $image_sizes[1];
      if($img_width <= $min_width && $img_height <= $min_height)
      {
        return $filepath;
      }
    }

    $ci   = &get_instance();
    /* Get file info using file path */
    $file_info = pathinfo($filepath);
    if(!empty($file_info)){
      $filename = $file_info['basename'];
      $ext      = $file_info['extension'];
      $dirname  = $file_info['dirname'].'/';
      $path     = $dirname.$filename;
      $file_status = @file_exists($path);
      if($file_status){
          $config['image_library']  = 'gd2';
          $config['source_image']   = $path;
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = $width;
          $config['height']         = $height;
          $config['file_permissions'] = 0777;
          $ci->load->library('image_lib', $config);
          $ci->image_lib->initialize($config);
          if(!$ci->image_lib->resize()) {
              return $path;
          } else {
            @chmod($path, 0777);
            $thumbnail = preg_replace('/(\.\w+)$/im', '', urlencode($filename)) . '_thumb.' . $ext;
            return 'uploads/'.$subfolder.'/'.urlencode($thumbnail);
          }
      }else{
        return $filepath;
      }
    }else{
      return $filepath;
    }
  }

    public function addEditGallery()
    {
        $table = 'gallery';
        $info = array();
        $id = '';
        $data = array('status' => 200, 'message' => '', 'responseData' => array());
        $data['postData'] = $info = $_POST;
        extract($_POST);
        $info['datetime'] = date('Y-m-d H:i:s');
        $original_image = $this->corefileUploading('image','gallery');
        $info['original_image'] = $original_image;
        $info['thumbnail_image'] = $this->get_image_thumb($original_image,'gallery',250,150);
        unset($info['image']);
        unset($info['type']);
        $r=0;
        if (empty($id)) {
            $id = $this->Commonmodel->save_data($table, $info);
            $msg = "Record successfully saved";
        } else {
            $this->Commonmodel->update_data($table, $info, "id = '$id'");
            $msg = "Record successfully updated";
        }
        $data['message'] = $msg;
        echo json_encode($data);
    }



}

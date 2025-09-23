<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MIK_Controller {

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
        $table = "product";
        $data = array();
        extract($this->input->post());
        $page = isset($page) ? $page : 1;
        $search = isset($searchValue) ? $searchValue : '';
        $where = "id != ''";
        $where.=(!empty($search)) ? " and (name = '$search' or name like '%$search%')" : "";
        $start = ($page - 1) * $limit;
        $lim = array('start' => $start, 'limit' => $limit);
        $fields = "*,(select name from category where product.catId = id) as category,(select name from category where product.subCatId = id) as subcategory";
        $dbCats = $this->Commonmodel->get_data($table, $where, $fields, "", $lim);
        $data['total'] = $total = $this->Commonmodel->get_count($table, $where);
        $data['q'] = $this->db->last_query();
        $data['dataList'] = $dbCats;
        echo json_encode($data);
    }

    public function getProduct() {
        $_POST = getJsonParam();
        $table = "product";
        $data = array();
        extract($this->input->post());
        $where = "id = '$id'";
        $fields = "*";
        $dbCats = $this->Commonmodel->get_single_data($table, $where, $fields);
        $data = $dbCats;
        echo json_encode($data);
    }

    public function getCategory() {
        $_POST = getJsonParam();
        $table = "category";
        $data = array();
        extract($this->input->post());
        $where = "catId = '0'";
        $fields = "*";
        $dbCats = $this->Commonmodel->get_data($table, $where, $fields);
        $data = $dbCats;
        echo json_encode($data);
    }

    public function getSubCategory() {
        $_POST = getJsonParam();
        $table = "category";
        $data = array();
        extract($this->input->post());
        $where = "catId = '$catId'";
        $fields = "*";
        $dbCats = $this->Commonmodel->get_data($table, $where, $fields);
        $data = $dbCats;
        echo json_encode($data);
    }

    public function deleteProduct() {
        $_POST = getJsonParam();
        $table = "product";
        $data = array();
        extract($this->input->post());
        $where = "id = '$id'";
        $this->Commonmodel->delete_data($table, $where);
        echo json_encode($data);
    }

    public function addEditImages() {
        $table = 'images';
        
        $data = array('status' => 200, 'message' => '', 'data' => array());
        $data['postData'] = $info = $_POST;
        if (isset($info['images'])) {
            unset($info['images']);
        }
        $data['files'] = $_FILES;
        extract($this->input->post());
        $info = array('productId'=>$productId);
        $dbdata = array();
        $im = "Please upload a image";
      
        if (count($_FILES) > 0) {
            foreach ($_FILES as $file => $fileData) {
                if (isset($_FILES[$file]) && !empty($_FILES[$file]['name'])) {
                    $imagename = time() . $_FILES[$file]['name'];
                    $im = $this->Commonmodel->uploadFile2($file, 'cms_images/product_images/original/', 'jpg|png|gif', $imagename, $resize = true, $resize_path = 'cms_images/product_images/thumb/', $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                    if ($im) {
                        $info['image'] = $imagename;
                    }
                    $rules['image'] = array('Image', 'callback_handleFileUpload[' . $im . ']');
                    $this->Commonmodel->setFormsValidation($rules);
                    if ($this->form_validation->run() == true) {
                           
                        $this->Commonmodel->save_data($table, $info);
                            $msg = "Record successfully saved";
                        $data['message'] = $msg;
                    } else {
                        $data['status'] = 201;
                        $data['message'] = strip_tags(validation_errors());
                    }
                }
            }
        }


        echo json_encode($data);
    }

    public function addEditProduct($id = '') {
        $table = 'product';
        $info = array();
        $data = array('status' => 200, 'message' => '', 'data' => array());
        $data['postData'] = $info = $_POST;
        if (isset($info['image'])) {
            
        }
        $data['files'] = $_FILES;
        extract($this->input->post());
        $rules['name'] = array('name', 'required');
        $rules['catId'] = array('category', 'required');
        $rules['subCatId'] = array('sub category', 'required');
        $rules['price'] = array('price', 'required');
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
                $im = $this->Commonmodel->uploadFile2('image', 'cms_images/product_images/original/', 'jpg|png|gif', $imagename, $resize = true, $resize_path = 'cms_images/product_images/thumb/', $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true);
                if ($im) {
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

    
    
    public function getProductImages() {
        extract($_GET);
        $table = "images";
        $data = array();
        $where = "productId = '$productId'";
        $fields = "*,concat('".  base_url('cms_images/product_images/thumb')."/',image) as image";
        $dbCats = $this->Commonmodel->get_data($table, $where, $fields);
        $data = $dbCats;
        echo json_encode($data);
    }
     public function deleteProductImage() {
        $_POST = getJsonParam();
        $table = "images";
        $data = array('status'=>'200');
        extract($this->input->post());
        $where = "id = '$id'";
        $idata = $this->Commonmodel->get_single_data($table,$where,"image");
        if(count($idata)>0)
        {
            unlink_files2(base_url("cms_images/product_images/large"), base_url("cms_images/product_images/small"),array($idata['image']));
        }
        $o=$this->Commonmodel->delete_data($table, $where);
        if($o)
        {
            $data['message']="Image deleted successfully";
        }else{
            $data['message']="Some error occured";
            $data['status']=201;
        }
        echo json_encode($data);
    }

}

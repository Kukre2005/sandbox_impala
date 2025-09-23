<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commonmodel extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function get_data($table, $where = '', $fields = '*', $order_by = '', $limit = array()) {
        $data = array();
        $this->db->select($fields, false);
        $this->db->from($table);

        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->where($where);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }

        if (count($limit) > 0) {
            $this->db->limit($limit['limit'], $limit['start']);
        }

        $query = $this->db->get();
        
        //echo $this->db->last_query();echo $where;exit;
        //echo $this->db->last_query();
        if($query){
        $data = $query->result_array();
        }else{
            log_message("error",  json_encode($this->db->error()));
            echo "<pre>".print_r($this->db->error(), true)."</pre>";
            
        }
        return $data;
    }

    public function get_single_data($table, $where = '', $fields = '*', $order_by = '', $limit = array()) {
        $data = array();
        $this->db->select($fields, false);
        $this->db->from($table);
        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->where($where);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }

        if (count($limit) > 0) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }
    
    public function get_table_field($table, $where = '', $fields = '*') {
        $data = array();
        $value="";
        $this->db->select($fields, false);
        $this->db->from($table);
        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        if($query)
        {
            $data = $query->row_array();
            $value= $data[$fields];
        }
        return $value;
    }

    public function get_join_data($table, $other_table = array(), $where = '', $fields = '*', $order_by = '', $limit = array()) {
        $this->db->select($fields, false);
        $this->db->from($table);
        if (count($other_table) > 0) {
            foreach ($other_table as $ot => $tabl) {
                # code...
                if (isset($tabl['name']) && isset($tabl['on'])) {
                    $tabname = $tabl['name'];
                    $tabon = $tabl['on'];
                    $type = (isset($tabl['type'])) ? $tabl['type'] : 'inner';
                    $this->db->join($tabname, $tabon, $type);
                }
            }
        }
        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->where($where);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }
        if (count($limit) > 0) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        $query = $this->db->get();

        //echo $this->db->last_query();exit;
        return $query->result_array();
    }

    public function get_count($table, $where = '') {

        $count = 0;

        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->from($table);
            $this->db->where($where);
            $count = $this->db->count_all_results();
        } else {
            $count = $this->db->count_all($table);
        }
        return $count;
    }

    public function save_data($table, $info = array()) {
        $insert_id = false;
        
        if (count($info) > 0) {
            try {
                
                $this->db->insert($table, $info);
                $insert_id = $this->db->insert_id();
            } catch (Exception $ex) {
                $errors = $this->db->error();  
                echo "<pre>".print_r($errors, true)."</pre>";
                exit;
                log_message('error', json_encode($errors));
            }
            
        }
        return $insert_id;
    }

    public function update_data($table, $info = array(), $where) {

        // $this->load->database();
        // print_r($this->db);
        if (isset($this->db->conn_id) && !empty($this->db->conn_id)) {
            // echo $table;echo "<br/>";
//              print_r($info);
//              print_r($where);exit;
            $affected_rows = false;
            // $where = implode(' = ',$where);
            if (!empty($where) || (is_array($where) && count($where) > 0)) {

                $this->db->update($table, $info, $where);
                //echo $this->db->last_query();exit;
                $affected_rows = $this->db->affected_rows();
            }
            return $affected_rows;
        }
    }

    public function delete_data($table, $where) {
        $deleted_rows = false;
        if (!empty($where) || (is_array($where) && count($where) > 0)) {
            $this->db->delete($table, $where);
            $deleted_rows = $this->db->affected_rows();
        }
        return $deleted_rows;
    }

    public function get_fields($table) {
        $fields = $this->db->list_fields($table);
        return $fields;
    }

    public function setFormsValidation($rules = array()) {
        foreach ($rules as $field => $rule) {
            # code...
            $this->form_validation->set_rules($field, $rule[0], $rule[1]);
        }
    }

    public function uploadFile2($field, $upload_path, $allowed_types, $imagename, $resize = false, $resize_path = '', $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true) {
        if (!empty($_FILES[$field]['name'])) {

            $res = array();
            $config = array(
                'upload_path' => $upload_path,
                'allowed_types' => $allowed_types,
                'file_name' => $imagename,
            );


            $config['max_width'] = '5000';
            $config['max_height'] = '4000';
            //print_r($config);
            //exit;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload($field)) {

                $upload_data = $this->upload->data();

                //print_r($upload_data);
                //exit;


                if ($resize == true) {
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['new_image'] = $resize_path . $upload_data['file_name'];
                    $config['source_image'] = $upload_data['full_path'];
                    $config['maintain_ratio'] = TRUE;
                    //$config['create_thumb'] = TRUE;
                    $config['overwrite'] = TRUE;
                    $config['width'] = $resize_dim['width'];
                    $config['height'] = $resize_dim['height'];
                    //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                    //$config['master_dim'] = ($dim > 0)? "height" : "width";
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    //echo $this->image_lib->display_errors();
                }
                if ($orig_resize['is'] == 'true' && ((!empty($orig_resize['w']) && $upload_data['image_width'] > $orig_resize['w']) || (!empty($orig_resize['h']) && $upload_data['image_height'] > $orig_resize['h']))) {
                    $this->load->library('image_lib');

                    $config['image_library'] = 'gd2';
                    $config['new_image'] = $upload_path . $upload_data['file_name'];
                    $config['source_image'] = $upload_data['full_path'];
                    $config['maintain_ratio'] = FALSE;
                    //$config['create_thumb'] = TRUE;
                    $config['overwrite'] = TRUE;
                    if (empty($orig_resize['w']) && $upload_data['image_width'] < $orig_resize['w']) {
                        unset($config['width']);
                    } else {
                        $config['width'] = $orig_resize['w'];
                    }

                    if (empty($orig_resize['h']) && $upload_data['image_height'] < $orig_resize['h']) {
                        unset($config['height']);
                    } else {
                        $config['height'] = $orig_resize['h'];
                    }
                    //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                    //$config['master_dim'] = ($dim > 0)? "height" : "width";
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    //print_r($config);exit;
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                if ($_FILES[$field]['size'] > 700000 && $compress == true) {
                    $compressed = compress_image($upload_data['full_path'], $upload_data['full_path'], 60);
                }
                return 1;
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $error = $this->upload->display_errors();
                //print_r($error);
                //exit;
                return $error;
            }
        } else {
            $error = "You must upload an image";
            return $error;
        }
    }

    public function multiuploadfile($field, $upload_path, $allowed_types, $name = array(), $resize = false, $resize_path = '', $resize_dim = array('width' => '120', 'height' => '120'), $orig_resize = array('is' => 'false', 'w' => '0', 'h' => ''), $compress = true) {
        if (isset($_FILES)) {
            $imagenames = array();
            $images = array();
            $config = array(
                'upload_path' => $upload_path,
                'allowed_types' => $allowed_types,
                    //'file_name'=>$imagename,
            );


            $config['max_width'] = '5000';
            $config['max_height'] = '4000';
            $config['encrypt_name'] = TRUE;

            $this->load->library('multiupload', $config);
            $this->multiupload->initialize($config);

            if ($this->multiupload->do_multi_upload($field)) {
                $multidata = ($this->multiupload->get_multi_upload_data());
                //
                if ($resize == true) {
                    foreach ($multidata as $upload_data) {
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['new_image'] = $resize_path . $upload_data['file_name'];
                        $config['source_image'] = $upload_data['full_path'];
                        $config['maintain_ratio'] = TRUE;
                        //$config['create_thumb'] = TRUE;
                        $config['overwrite'] = TRUE;
                        $config['width'] = $resize_dim['width'];
                        $config['height'] = $resize_dim['height'];
                        //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                        //$config['master_dim'] = ($dim > 0)? "height" : "width";
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        //echo $this->image_lib->display_errors();
                        if ($orig_resize['is'] == 'true' && ((!empty($orig_resize['w']) && $upload_data['image_width'] > $orig_resize['w']) || (!empty($orig_resize['h']) && $upload_data['image_height'] > $orig_resize['h']))) {
                            $this->load->library('image_lib');

                            $config['image_library'] = 'gd2';
                            $config['new_image'] = $upload_path . $upload_data['file_name'];
                            $config['source_image'] = $upload_data['full_path'];
                            $config['maintain_ratio'] = FALSE;
                            //$config['create_thumb'] = TRUE;
                            $config['overwrite'] = TRUE;
                            if (empty($orig_resize['w']) && $upload_data['image_width'] < $orig_resize['w']) {
                                unset($config['width']);
                            } else {
                                $config['width'] = $orig_resize['w'];
                            }

                            if (empty($orig_resize['h']) && $upload_data['image_height'] < $orig_resize['h']) {
                                unset($config['height']);
                            } else {
                                $config['height'] = $orig_resize['h'];
                            }
                            //$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                            //$config['master_dim'] = ($dim > 0)? "height" : "width";
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            //print_r($config);exit;
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        if ($upload_data['file_size'] > 700 && $compress == true) {
                            $compressed = compress_image($upload_data['full_path'], $upload_data['full_path'], 60);
                        }
                        $imagenames[] = $upload_data['file_name'];
                    }
                }

                return $imagenames;
            } else {
                //$error = array('error' => $this->upload->display_errors());

                $error = $this->multiupload->display_errors();
                // print_r($error);
                // exit;
                return $error;
            }
        } else {
            $error = "You must upload an image";
            return $error;
        }
    }

}

<?php
$data = array();
$mo = (!empty($mo)) ? $mo : 'home';
$msg = (isset($msg)) ? $msg : '';
$mstatus = (isset($mstatus)) ? $mstatus : '';
$msg = ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : $msg;
$data['errormsg'] = ($this->session->flashdata('errormsg')) ? $this->session->flashdata('errormsg') : "";
$data['msg'] = $msg;
$data['mstatus'] = $mstatus;
?>
<!-- DOCTYPE -->
<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('include/head', $data); ?>
    <style type="text/css">.verror{color:red;}
        </style>
    <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGVRCST"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
 <?php $this->load->view('include/header'); ?>
 <?php $this->load->view('include/promocion.html'); ?>  
 <?php $this->load->view('module/' . $mo, $data); ?>
        <?php $this->load->view('include/footer'); ?>
    </body>
</html>
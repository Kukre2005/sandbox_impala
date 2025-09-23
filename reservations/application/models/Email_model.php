<?php

class Email_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function sendEmail($to = null, $subject = null, $message = null, $attachment = "", $from = null, $from_name = null) {

        $this->load->library('email');

//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'utf-8';
//        $config['mailtype'] = 'html';
//        $config['wordwrap'] = TRUE;


            $config['protocol']    = 'smtp';

            $config['smtp_host']    = 'ssl://mail.impalacabo.com';

            $config['smtp_port']    = '465';
            //$config['smtp_port']    = '587';

            $config['smtp_timeout'] = '7';

            $config['smtp_user']    = 'paypal@impalacabo.com';

            $config['smtp_pass']    = 'h%MPT^vb+7$f';

            $config['charset']    = 'utf-8';

            $config['newline']    = '\r\n';

            $config['mailtype'] = 'html'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->clear(true);
            $this->email->initialize($config);

        $this->email->initialize($config);

        $this->email->from($from, ucfirst($from_name));

        $this->email->to($to);

        $this->email->subject($subject);

        $this->email->message($message);
        if (!empty($attachment)) {
            if(is_array($attachment)){
                foreach ($attachment as $key => $value) {
                    $this->email->attach($value);
                }
            }else{
                $this->email->attach($attachment);
            }
        }
        if ($this->email->send())
            return true;
        else
            echo "<pre>".print_r ($this->email->print_debugger(), true)."</pre>";
        exit;
            return $this->email->print_debugger();
    }

}

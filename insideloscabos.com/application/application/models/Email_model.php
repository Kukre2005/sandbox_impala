<?php

class Email_model extends CI_Model
{
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  public function sendEmail(
    $to = null,
    $subject = null,
    $message = null,
    $attachment = "",
    $from = null,
    $from_name = null
  ) {
    $this->load->library("email");

    $config["protocol"] = "smtp";
    // $config["smtp_host"] = "sandbox.smtp.mailtrap.io";
    $config["smtp_host"] = "ssl://mail.insideloscabos.com";
    $config["smtp_port"] = "465";
    // $config["smtp_port"] = "2525";
    $config["smtp_timeout"] = "7";
    $config["smtp_user"] = "no_reply@insideloscabos.com";
    // $config["smtp_user"] = "8aaf023af08";
    $config["smtp_pass"] = "exz05]@hqu[A";
    // $config["smtp_pass"] = "71adfbb126";
    $config["charset"] = "utf-8";
    $config["newline"] = "\r\n";
    $config["mailtype"] = "html";
    $config["validation"] = true;

    $this->email->initialize($config);

    $this->email->from($config["smtp_user"], ucfirst($from_name));
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    if (!empty($attachment)) {
      if (is_array($attachment)) {
        foreach ($attachment as $key => $value) {
          $this->email->attach($value);
        }
      } else {
        $this->email->attach($attachment);
      }
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo "<pre>" . print_r($this->email->print_debugger(), true) . "</pre>";
    }
    exit();
    return $this->email->print_debugger();
  }
}

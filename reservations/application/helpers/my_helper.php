<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



function generateOtp($n = 4) {

    $a = "";

    for ($i = 0; $i < $n; $i++) {

        $a .= mt_rand(0, 9);

    }

    return $a;

}



function sms($mobile, $messege) {

    $messege = urlencode($messege);

    $mobile = (is_array($mobile)) ? implode(',', $mobile) : $mobile;



    $mobile = urlencode($mobile);

    $smsApiUrl = APIURL . '?username=' . USERNAME . '&password=' . PASSWORD . '&mobile=' . $mobile . '&senderid=' . SENDERID . '&message=' . $messege;



    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $smsApiUrl);

    //curl_setopt($ch, CURLOPT_PROXY, '10.1.0.36:80');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);

    curl_close($ch);

}



function getJsonParam($field = '') {

    $params = json_decode(file_get_contents('php://input'), TRUE);

    if (!empty($field)) {

        $params = $params[$field];

    }

    return $params;

}



function randomPassword() {

    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

    $pass = array(); //remember to declare $pass as an array

    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

    for ($i = 0; $i < 8; $i++) {

        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];

    }

    return implode($pass); //turn the array into a string

}



//For Android

function androidInstantPush($registrationIds = array(), $message, $pushToken, $pushId, $headers = array()) {

    // prep the bundle

    $msg = array("pushMessage" =>

        array('message' => $message,

            'title' => 'Add Rating',

            'vibrate' => 1,

            'sound' => 1,

            'largeIcon' => 'icon.png',

            'smallIcon' => 'icon.png',

            'pushToken' => $pushToken,

            'pushId' => $pushId

        )

    );

    $fields = array

        (

        'registration_ids' => $registrationIds,

        'data' => $msg

    );



//        $headers = array

//            (

//            'Authorization: key=AIzaSyCGCpAhjUVXb6sJJ1A7f2WQ5N-R_Vv2v_8',

//            'Content-Type: application/json'

//        );



    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}



//For Ios

function iosInstantPush($deviceTokens = array(), $message, $pem, $passphrase) {





//        

//        // Put your device token here (without spaces):

//        $deviceToken = 'dffa46e16995057c2a58ea8fb8f5390978e254a0ab8b06bc427df3356f51f95a';

//// Put your private key's passphrase here:

//        $passphrase = '123456';

//// Put your alert message here:

//        $message = 'A push notification has been sent!';

////////////////////////////////////////////////////////////////////////////////

    $ctx = stream_context_create();

    stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);

    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server

    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

    if (!$fp)

        exit("Failed to connect: $err $errstr" . PHP_EOL);

    echo 'Connected to APNS' . PHP_EOL;

// Create the payload body

    $body['aps'] = array(

        'alert' => array(

            'body' => $message,

            'action-loc-key' => 'Bango App',

            'additionalData' => array('unReadMsgCount' => 10)

        ),

        'badge' => 2,

        'sound' => 'oven.caf',

    );

// Encode the payload as JSON

    $payload = json_encode($body);

// Build the binary notification

    foreach ($deviceTokens as $deviceToken) {

        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)

            echo 'Message not delivered' . PHP_EOL;

        else

            echo 'Message successfully delivered' . PHP_EOL;

    }

// Close the connection to the server

    fclose($fp);

}

function time_elapsed_string($datetime, $full = false) {

    $now = new DateTime;

    $ago = new DateTime($datetime);

    $diff = $now->diff($ago);



    $diff->w = floor($diff->d / 7);

    $diff->d -= $diff->w * 7;



    $string = array(

        'y' => 'year',

        'm' => 'month',

        'w' => 'week',

        'd' => 'day',

        'h' => 'hour',

        'i' => 'minute',

        's' => 'second',

    );

    foreach ($string as $k => &$v) {

        if ($diff->$k) {

            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');

        } else {

            unset($string[$k]);

        }

    }



    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';

}



function slugify($text) {

    // replace non letter or digits by -

    $text = preg_replace('~[^\pL\d]+~u', '-', $text);



    // transliterate

    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);



    // remove unwanted characters

    $text = preg_replace('~[^-\w]+~', '', $text);



    // trim

    $text = trim($text, '-');



    // remove duplicate -

    $text = preg_replace('~-+~', '-', $text);



    // lowercase

    $text = strtolower($text);



    if (empty($text)) {

        return 'n-a';

    }



    return $text;

}



function make_bitly_url($url, $login, $appkey, $format = 'xml', $version = '2.0.1') {

    //create the URL

    $bitly = 'http://api.bit.ly/shorten?version=' . $version . '&longUrl=' . urlencode($url) . '&login=' . $login . '&apiKey=' . $appkey . '&format=' . $format;



    //get the url

    //could also use cURL here

    $response = file_get_contents($bitly);



    //parse depending on desired format

    if (strtolower($format) == 'json') {

        $json = @json_decode($response, true);

        return $json['results'][$url]['shortUrl'];

    } else { //xml

        $xml = simplexml_load_string($response);

        return 'http://bit.ly/' . $xml->results->nodeKeyVal->hash;

    }

}



function detectMobile() {

    $useragent = $_SERVER['HTTP_USER_AGENT'];



    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {

        return true;

    }

    return false;

}



if (!function_exists('sendMail')) {



    function sendMail($email, $subject, $template, $ccMail = false, $attach = '') {

        $ci = & get_instance();

        $fromEmail = FROMEMAIL;

        $fromName = FROMNAME;

        $config = Array(

            'protocol' => PROTOCOL,

            'smtp_host' => SMTPHOST,

            'smtp_port' => SMTPPORT,

            'smtp_user' => SMTPUSER,

            'smtp_pass' => SMTPPASS,

            'mailtype' => MAILTYPE,

            'charset' => CHARSET,

            'newline' => NEWLINE

        );

        $ci->load->library('email', $config);



        $ci->email->clear();

        $ci->email->set_newline("\r\n");

        $ci->email->to($email);

        if ($ccMail) {

            $ci->email->cc($ccMail);

        }

        $ci->email->from($fromEmail, $fromName);

        $ci->email->subject($subject);

        $ci->email->message($template);

        if (!empty($attach)) {

            if (is_array($attach)) {

                foreach ($attach as $att) {

                    $ci->email->attach($att);

                }

            } else {

                $ci->email->attach($attach);

            }

        }

        $result = $ci->email->send();

        $ci->email->clear(TRUE);

        //echo $ci->email->print_debugger();

        return $result;

    }



}



function cap($key, $value) {

    return ucfirst($key);

}



if (!function_exists('roundUp')) {



    function roundUp($num, $divisor) {

        $diff = $num % $divisor;

        if ($diff == 0) {

            return $num;

        } else {

            return ($num - $diff) + $divisor;

        }

    }



}



if (!function_exists('convertNumberFormate')) {



    function convertNumberFormat($number, $fromEnd = false, $endSymbol, $conversionSymbol) {

        if ($number) {

            $fromEnd = (!$fromEnd) ? 2 : $fromEnd;

            //$number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);

            return number_format($number, $fromEnd, '.', ',');

        }

    }



}





if (!function_exists('getCodeMessage')) {



    function getCodeMessage($code) {

        $messageArray = array(

            200 => 'success',

            201 => 'server is connected but unable to get result. Please try again.',

            404 => 'The server has not found anything matching the URI given'

        );

        return (isset($messageArray[$code]) && !empty($messageArray[$code])) ? $messageArray[$code] : false;

    }



}



if (!function_exists('mlpLoader')) {



    function mlpLoader($classname = false) {



        $html = '<div class="spinner loader ' . $classname . '" style="display:none;"><div class="inner one"></div><div class="inner two"></div><div class="inner three"></div><div class="loader-icon"></div></div>';

        return $html;

    }



}





if (!function_exists('current_url2')) {



    function current_url2() {

        $CI = & get_instance();



        $url = $CI->config->site_url($CI->uri->uri_string());

        return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;

    }



}





function random_string($length) {

    $key = '';

    $keys = array_merge(range(0, 9), range('a', 'z'));



    for ($i = 0; $i < $length; $i++) {

        $key .= $keys[array_rand($keys)];

    }



    return $key;

}



// http://www.itnewb.com/v/Generating-Session-IDs-and-Random-Passwords-with-PHP

function generate_token($len = 32) {

// Array of potential characters, shuffled.

    $chars = array(

        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',

        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',

        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'

    );

    shuffle($chars);

    $num_chars = count($chars) - 1;

    $token = '';

// Create random token at the specified length.

    for ($i = 0; $i < $len; $i++) {

        $token .= $chars[mt_rand(0, $num_chars)];

    }

    return $token;

}



function gete($arr) {

    return ucwords(str_replace('_', ' ', $arr));

}



function parseData($message, $param) {

    $message = str_replace(array_keys($param), array_values($param), $message);

    return $message;

}



// function makeid(l=8)

// {

//     var text = "";

//     var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

//     for( var i=0; i < l; i++ )

//         text += possible.charAt(Math.floor(Math.random() * possible.length));

//     return text;

// }



function random_password($length = 8) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";

    $password = substr(str_shuffle($chars), 0, $length);

    return $password;

}



function get_paging($burl, $count, $per_page) {

    $this->load->library('pagination');



    $config['base_url'] = $burl;

    //$count=100;

    $config['total_rows'] = $count;

    $config['use_page_numbers'] = TRUE;

    $config['per_page'] = $per_page;

    $config['full_tag_open'] = '<ul class="pagination">';

    $config['full_tag_close'] = '</ul>';

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



function geninvoiceid($unique_ref_length = 8) {





    // A true/false variable that lets us know if we've  

    // found a unique reference number or not  

    $unique_ref_found = false;



    // Define possible characters.  

    // Notice how characters that may be confused such  

    // as the letter 'O' and the number zero don't exist  

    $possible_chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuv";



    // Until we find a unique reference, keep generating new ones  

    while (!$unique_ref_found) {



        // Start with a blank reference number  

        $unique_ref = "";



        // Set up a counter to keep track of how many characters have   

        // currently been added  

        $i = 0;



        // Add random characters from $possible_chars to $unique_ref   

        // until $unique_ref_length is reached  

        while ($i < $unique_ref_length) {



            // Pick a random character from the $possible_chars list  

            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars) - 1), 1);



            $unique_ref .= $char;



            $i++;

        }







        // We've found a unique number. Lets set the $unique_ref_found  

        // variable to true and exit the while loop  

        $unique_ref_found = true;

    }

    return $unique_ref;

}



function set_iframe_code($iframe, $width, $height) {

    $iframe = preg_replace('/height="(.*?)"/i', 'height="' . $height . '"', $iframe);

    $iframe = preg_replace('/width="(.*?)"/i', 'width="' . $width . '"', $iframe);

    return $iframe;

}



function set_iframe_code2($yt, $width, $height) {

    $iframe = '<iframe width="' . $width . '" height="' . $height . '" src="' . $yt . '" frameborder="0" allowfullscreen></iframe>';

    return $iframe;

}



function get_youtube_video_id($url) {

    preg_match('/v=([a-zA-Z0-9\_\-]+)&?/', $url, $matches);

    $vid = $matches[1];

    return $vid;

}



function convert_youtube($url) {

    preg_match('/v=([a-zA-Z0-9\_\-]+)&?/', $url, $matches);

    $vid = $matches[1];

    $v = "https://www.youtube.com/embed/$vid";

    return $v;

}



function unlink_files($files) {

    foreach ($files as $f) {

        if (file_exists($f)) {

            unlink($f);

        }

    }

}



function unlink_files2($op, $tp, $files) {

    foreach ($files as $f) {

        $oo = $op . $f;

        $ot = $tp . $f;

        if (file_exists($oo)) {

            unlink($oo);

        }

        if (file_exists($ot)) {

            unlink($ot);

        }

    }

}



function convertDate($date, $curr_format, $con_format) {

    

    $newdate = DateTime::createFromFormat($curr_format, $date)->format($con_format);

    return $newdate;

}



function pagination($total, $per_page, $page, $url) {

    global $conDB;

    $adjacents = "2";



    $prevlabel = "&lsaquo; Prev";

    $nextlabel = "Next &rsaquo;";

    $lastlabel = "Last &rsaquo;&rsaquo;";



    $page = ($page == 0 ? 1 : $page);

    $start = ($page - 1) * $per_page;



    $prev = $page - 1;

    $next = $page + 1;



    $lastpage = ceil($total / $per_page);



    $lpm1 = $lastpage - 1; // //last page minus 1



    $pagination = "";

    if ($lastpage > 1) {



        $pagination .= "<ul class='pagination'>";





        if ($page > 1)

            $pagination.= "<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";



        if ($lastpage < 7 + ($adjacents * 2)) {

            for ($counter = 1; $counter <= $lastpage; $counter++) {

                if ($counter == $page)

                    $pagination.= "<li><a class='current'>{$counter}</a></li>";

                else

                    $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";

            }

        } elseif ($lastpage > 5 + ($adjacents * 2)) {



            if ($page < 1 + ($adjacents * 2)) {



                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";

                }

                $pagination.= "<li class='dot'>...</li>";

                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";

            } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {



                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";

                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";

                $pagination.= "<li class='dot'>...</li>";

                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";

                }

                $pagination.= "<li class='dot'>..</li>";

                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";

            } else {



                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";

                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";

                $pagination.= "<li class='dot'>..</li>";

                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";

                }

            }

        }



        if ($page < $counter - 1) {

            $pagination.= "<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";

            $pagination.= "<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";

        }



        $pagination.= "</ul>";

        $pagination .= "<div class='page_info'>Page {$page} of {$lastpage}</div>";

    }



    return $pagination;

}



function getext($file) {

    $e = end(explode(".", $file));

    return $e;

}



function just_clean($str) {

    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);

    $clean = strtolower(trim($clean, '-'));

    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);



    return $clean;

}



function image_resize_up($orig_w, $orig_h, $MIN_W, $MIN_H) {

    $ratio = $orig_w * 1.0 / $orig_h;



    $w_undersized = ($orig_w < $MIN_W);

    $h_undersized = ($orig_h < $MIN_H);



    if ($w_undersized OR $h_undersized) {

        $new_w = round(max($MIN_W, $ratio * $MIN_H));

        $new_h = round(max($MIN_H, $MIN_W / $ratio));

        return array('width' => $new_w, 'height' => $new_h);

    }

    return null;

}



function image_resize_down($orig_w, $orig_h, $MAX_W, $MAX_H) {

    $ratio = $orig_w * 1.0 / $orig_h;



    $w_undersized = ($orig_w > $MAX_W);

    $h_undersized = ($orig_h > $MAX_H);



    if ($w_undersized OR $h_undersized) {

        $new_w = round(min($MAX_W, $ratio * $MAX_H));

        $new_h = round(min($MAX_H, $MAX_W / $ratio));

        return array('width' => $new_w, 'height' => $new_h);

    }

    return null;

}



function compress_image($source_url, $destination_url, $quality) {

    $info = getimagesize($source_url);



    if ($info['mime'] == 'image/jpeg')

        $image = imagecreatefromjpeg($source_url);

    elseif ($info['mime'] == 'image/gif')

        $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')

        $image = imagecreatefrompng($source_url);



    //save file

    imagejpeg($image, $destination_url, $quality);



    //return destination file

    return $destination_url;

}



// $c = false; 

// $vertices_x = array(22.333,22.222,22,444);  //latitude points of polygon

// $vertices_y = array(75.111,75.2222,76.233);   //longitude points of polygon

// $points_polygon = count($vertices_x); 

// $longitude =  23.345; //latitude of point to be checked

// $latitude =  75.123; //longitude of point to be checked

// if (is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude, $latitude)){

//     echo "Is in polygon!"."<br>";

// }

// else { 

//     echo "Is not in polygon"; 

// }



function is_in_polygon($vertices_x, $vertices_y, $longitude_x, $latitude_y) {

    $i = $j = $c = 0;

    $points_polygon = count($vertices_x);

    for ($i = 0, $j = $points_polygon - 1; $i < $points_polygon; $j = $i++) {

        if (($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])) {

            $c = !$c;

        }

    }



    return $c;

}



//usage

function Get_Address_From_Google_Maps($lat, $lon) {



    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";



// Make the HTTP request

    $data = @file_get_contents($url);

// Parse the json response

    $jsondata = json_decode($data, true);



// If the json data is invalid, return empty array

    if (!check_status($jsondata))

        return array();



    $address = array(

        'country' => google_getCountry($jsondata),

        'province' => google_getProvince($jsondata),

        'city' => google_getCity($jsondata),

        'street' => google_getStreet($jsondata),

        'postal_code' => google_getPostalCode($jsondata),

        'country_code' => google_getCountryCode($jsondata),

        'formatted_address' => google_getAddress($jsondata),

    );



    return $address;

}



/*

 * Check if the json data from Google Geo is valid 

 */



function check_status($jsondata) {

    if ($jsondata["status"] == "OK")

        return true;

    return false;

}



/*

 * Given Google Geocode json, return the value in the specified element of the array

 */



function google_getCountry($jsondata) {

    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);

}



function google_getProvince($jsondata) {

    return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);

}



function google_getCity($jsondata) {

    return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);

}



function google_getStreet($jsondata) {

    return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);

}



function google_getPostalCode($jsondata) {

    return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);

}



function google_getCountryCode($jsondata) {

    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);

}



function google_getAddress($jsondata) {

    return $jsondata["results"][0]["formatted_address"];

}



/*

 * Searching in Google Geo json, return the long name given the type. 

 * (If short_name is true, return short name)

 */



function Find_Long_Name_Given_Type($type, $array, $short_name = false) {

    foreach ($array as $value) {

        if (in_array($type, $value["types"])) {

            if ($short_name)

                return $value["short_name"];

            return $value["long_name"];

        }

    }

}



/*

 *  Print an array

 */



function pr($a) {

    echo "<pre>";

    print_r($a, true);

    echo "</pre>";

}
?> 
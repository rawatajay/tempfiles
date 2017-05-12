<?php

class User_model extends CI_Model {

    var $table = "user";

    function register($dataArray = array()) {
        $this->db->insert($this->table, $dataArray);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $this->db->insert_id();            
        }
    }

    function mysechdule($dataArray = array()) {
        $this->db->insert('hb_availability', $dataArray);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $this->db->insert_id();
        }
    }

    function _getState(){
        $this->db->from('state');
        $query= $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    function updateUserDetail($condition = array(), $dataArray = array()) {        
        $this->db->from($this->table);
        $this->db->where($condition);
        $update = $this->db->update('user', $dataArray);        
        if ($update)
            return true;
        else
            return false;
    }

    function getuserDetailBYCode($condition) {        
        $this->db->from($this->table);
        $this->db->where($condition);
        $query = $this->db->get();       
        $userData = $query->row_array();
        if (!empty($userData)) {
            return $userData;
        } else {
            return false;
        }
    }

    function setPassword($condition, $password) {
        $dataArray = array('code' => '', 'password' => $password);
        $this->db->from($this->table);
        $this->db->where($condition);
        $update = $this->db->update('user', $dataArray);
        if ($update)
            return true;
        else
            return false;
    }

    function updateByEmail($condition, $data) {
        $dataArray = $data;
        $this->db->from($this->table);
        $this->db->where($condition);
        $update = $this->db->update('users', $dataArray);
        if ($update){
             $this->db->from('users');
             $this->db->where($condition);
             $query = $this->db->get();
             $userData = $query->row_array();

             if (!empty($userData))
                return $userData;
             else {
                return false;
             }
        }
        else
            return false;
    }

    function loginUser($data) {

        //$this->db->select("ID,email,password");
        $this->db->from('user');
        $this->db->where($data);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $userData = $query->row_array();
        if ($query->num_rows() > 0) {
            return $userData;
        } else {
            return false;
        }
    }

    public function _isValid_user($email = '', $password = '') {
        $condition = array('email' => $email, 'password' => md5($password));
        $query = $this->db->get_where($this->table, $condition);

        if ($email && $password) {
            return $query->row_array();
        }

        return FALSE;
    }

   

    function getuserBYEmail($email) {

        //$this->db->select("ID,email,password");
        $this->db->from('user');
        $this->db->where(array('email' => $email));
        $query = $this->db->get();
        $userData = $query->row_array();

        if (!empty($userData))
            return $userData;
        else {
            return false;
        }
    }

    function getuserBYId($userid) {

        //$this->db->select("ID,email,password");
        $this->db->from('users');
        $this->db->where(array('user_id' => $userid));
        $query = $this->db->get();
        $userData = $query->row_array();

        if (!empty($userData))
            return $userData;
        else {
            return false;
        }
    }

    

    function _checkfbemailexist($fbid , $email) {

        $this->db->from('users');
        $this->db->where(array('email' => $email, 'facebookid' => $fbid));
        $query = $this->db->get();
        $userData = $query->row_array();

        if (!empty($userData))
            return $userData;
        else {
            return false;
        }
    }

    public function updateFacebookID($id, $dataArray) {

        $this->db->from($this->table);
        $this->db->where(array('userId' => $id));
        $update = $this->db->update('user', $dataArray);
        //echo $this->db->last_query();
    }
    
     public function activationmail($email, $name, $code){

        $message = '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>Job Hunter</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><p>Dear, {NAME}</p>Please activate your account address by clicking the link below.</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITENAME} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';

        $link = base_url('activation') . "/" . $code;
        $patternFind1[0] = '/{NAME}/';
        $patternFind1[1] = '/{LINK}/';
        $patternFind1[2] = '/{SITENAME}/';

        $replaceFind1[0] = ucwords($name);
        $replaceFind1[1] = $link;
        $replaceFind1[2] = SITE_TITLE;

        $txtdesc_contact = stripslashes($message);
        $contact_sub = stripslashes($subject);
        $contact_sub = preg_replace($patternFind1, $replaceFind1, $contact_sub);
        $ebody_contact = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
        $this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
        $this->phpmailer->Host          = SMTPHOST;  // specify main and backup server
        $this->phpmailer->SMTPAuth      = true;     // turn on SMTP authentication
        $this->phpmailer->SMTPSecure    = "ssl";
        $this->phpmailer->Port          = SMTPPORT;
        $this->phpmailer->Username      = SMTPEMAIL;  // SMTP username
        $this->phpmailer->Password      = SMTPPASS; // SMTP password
        $this->phpmailer->SMTPAuth      = true;
        $this->phpmailer->From          = ADMINEMAIL;
        $this->phpmailer->FromName      = SITE_TITLE;
        $this->phpmailer->AddAddress($email, $name);
                       // name is optional
        $this->phpmailer->AddReplyTo(ADMINEMAIL, SITE_TITLE);

      
        $this->phpmailer->IsHTML(true);                                  // set email format to HTML

        $this->phpmailer->Subject = "Job Hunter : Activate your account.";
        $this->phpmailer->Body    = $ebody_contact;
        

        if(!$this->phpmailer->Send())
        {
           echo "Message could not be sent. <p>";
           echo "Mailer Error: " . $this->phpmailer->ErrorInfo;
           exit;
        }       
    }
    public function _sendActivationEmail($toemail, $name, $code) {

        //$msg = $this->configuration->_getMessage('activate_user');
        //$from_email=getSetting('admin_email'); echo $from_email; exit;
        //$link = base_url('activation') . "/" . $code;
        //echo "asdad";die;
        /*$patternFind1[0] = '/{NAME}/';
        $patternFind1[1] = '/{ACTIVATIONLINK}/';
        $patternFind1[2] = '/{SITENAME}/';

        $replaceFind1[0] = $name;
        $replaceFind1[1] = '<a href="' . $link . '" target="_blank">' . $link . '</a>';
        $replaceFind1[2] = SITE_TITLE;

        $txtdesc_contact = stripslashes($message);
        $contact_sub = stripslashes($subject);
        $contact_sub = preg_replace($patternFind1, $replaceFind1, $contact_sub);
        $ebody_contact = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);*/


        $config['protocol'] = 'smtp';
        // SMTP Server Address for Gmail.
        $config['smtp_host'] = 'smtp.google.com';
        // SMTP Port - the port that you is required
        $config['smtp_port'] = 465;
        // SMTP Username like. (abc@gmail.com)
        $config['smtp_user'] = 'ajay.trivialworks@gmail.com';
        // SMTP Password like (abc***##)
        $config['smtp_pass'] = 'software9';
        // Load email library and passing configured values to email library
        $this->load->library('email', $config);
        // Sender email address
        $this->email->from(ADMINEMAIL, 'Ajay Singh');           
        //send multiple email
        $this->email->to($toemail);
        // Subject of email
        $this->email->subject($subject);
        // Message in email
        $this->email->message('asdsadads');
        // It returns boolean TRUE or FALSE based on success or failure
        $this->email->send(); 
         echo $this->email->print_debugger();die;
        /*$message = "<p>Welcome to the job hunter . Click on the link below to active your account:</p>";
        $subject = "JOB HUNTER : Activate your account";

        

        //$this->email->from($this->adminEmail, SITE_TITLE);
        $this->email->from(ADMINEMAIL, SITE_TITLE);
        $this->email->to($toemail);
        $this->email->subject($contact_sub);
        $this->email->message($ebody_contact);
        $this->email->send();
        echo $this->email->print_debugger();
        echo "asdsad";die;*/
    }

    public function _sendForgotEmail($toemail, $id, $name, $code) {

        $msg = $this->configuration->_getMessage('forgot_password');
        //$from_email=getSetting('admin_email'); echo $from_email; exit;

        $message = html_entity_decode($msg->content);
        $subject = html_entity_decode($msg->subject);

        $link = site_url('resetpassword') . "/" . $code;

        $patternFind1[0] = '/{name}/';
        $patternFind1[1] = '/{link}/';
        $patternFind1[2] = '/{admin_mail}/';
        $patternFind1[3] = '/{SITENAME}/';

        $replaceFind1[0] = $name;
        $replaceFind1[1] = '<a href="' . $link . '" target="_blank">' . $link . '</a>';
        $replaceFind1[2] = $this->configuration->__get('adminEmail');

        $replaceFind1[3] = $this->configuration->__get('site_title');

        $txtdesc_contact = stripslashes($message);
        $contact_sub = stripslashes($subject);
        $contact_sub = preg_replace($patternFind1, $replaceFind1, $contact_sub);
        $ebody_contact = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);

        //$this->email->from($this->adminEmail, SITE_TITLE);
        $this->email->from('anoop@singsys.com', 'Sports Done Right');
        $this->email->to($toemail);
        $this->email->subject($contact_sub);
        $this->email->message($ebody_contact);
        $this->email->send();
        echo $this->email->print_debugger();
    }

    public function is_emailExist($id, $email) {
        if ($id == "" || $email == "") {
            return false;
        }
        $this->db->from('users');
        $this->db->where(array('email' => $email));
        $this->db->where(array('user_id != ' => $id));
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return false;
        else {
            return true;
        }
    }

    public function _isValid_oldpassword($id = '', $password = '') {
        if (!$id && !$password) {
            return false;
        }

        $condition = array('user_id' => $id, 'password' => md5($password));
        $query = $this->db->get_where($this->table, $condition);
        return ($query->num_rows() > 0) ? true : false;

        return false;
    }

   


    function _deleteUser($userId) {

        $this->db->where('user_id', $userId);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    function getuserDetail($condition) {
        $this->db->from($this->table);
        $this->db->where($condition);
        $query = $this->db->get();
        $userData = $query->row_array();
        if (!empty($userData)) {
            $dataArray = array('code' => '', 'isActive' => '1');
            $this->db->from($this->table);
            $this->db->where($condition);
            $update = $this->db->update('user', $dataArray);                   
            //   echo $this->db->last_query(); die;
            if ($update)
                return $userData;
            else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkSocialID($facebookID) {
        $condition = array('facebookId' => $facebookID);
        $query = $this->db->get_where($this->table, $condition);
      // echo $this->db->last_query();   die;

        if ($facebookID) {
            return $query->row_array();
        }
        return FALSE;
    }

    

}
<?php

class Auth_model extends CI_Model {
	function loginUser($data) {
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
    function forgotpassword($condition = array(), $dataArray = array()) {        
        $this->db->where($condition);
        $update = $this->db->update('user', $dataArray);        
        if ($update){
            $q=$this->db->get_where('user',$condition);
            if($q->num_rows()>0){
                $res = $q->row();
                return ucwords($res->name);
            }
            else{
                return "User";
            }
        }else
            return false;
    }
    // forget password tamplate
    function forgot_pass_template(){
        return '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>{SITETITLE}</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">We heard that you lost your  password. Sorry about that!.<br>But don’t worry! You can use the following link to reset your password:</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITETITLE} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';
    }
    // create account tamplate
    public function create_Account_tamplate() {
        return '<table style="max-width:600px" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><table style="min-width:332px;max-width:600px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px" cellspacing="0" cellpadding="0" border="0" bgcolor="#D94235" width="100%"><tbody><tr><td colspan="3" height="72px"></td></tr><tr><td width="32px"></td><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:24px;color:#ffffff;line-height:1.25">Welcome to the Trivial Works.</td><td width="32px"></td></tr><tr><td colspan="3" height="18px"></td></tr></tbody></table></td></tr><tr><td><table style="min-width:332px;max-width:600px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px" cellspacing="0" cellpadding="0" border="0" bgcolor="#FAFAFA" width="100%"><tbody><tr height="16px"><td rowspan="3" width="32px"></td><td></td><td rowspan="3" width="32px"></td></tr><tr><td><table style="min-width:300px" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-bottom:4px">Hi {NAME},</td></tr><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding:4px 0">Your Trivial Works account has been created. Please find the login credential below.<br><br><b>Email or Employee ID : </b> {ACCOUNT}<br><b>Password : </b> {PASSWORD}<br></td></tr><tr><td style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5;padding-top:28px">Thanks,<br>Trivial Works Team,</td></tr><tr height="16px"></tr><tr><td><table style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12px;color:#b9b9b9;line-height:1.5"><tbody><tr></tr></tbody></table></td></tr></tbody></table></td></tr><tr height="32px"></tr></tbody></table></td></tr></tbody></table>';
    }
}
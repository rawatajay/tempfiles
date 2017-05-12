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
                return ucwords($res->firstName." ".$res->lastName);
            }
            else{
                return "User";
            }
        }else
            return false;
    }
    function forgot_pass_template(){
        return '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>{SITETITLE}</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">We heard that you lost your  password. Sorry about that!.<br>But don’t worry! You can use the following link to reset your password:</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITETITLE} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';
    }
}
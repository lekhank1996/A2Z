<?php

Class Userlogin extends CI_Model {

    function logincheck($username, $password)
    {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("username", $username);
        $authentication = $this->db->get();
        $result = $authentication->result_array();
        
        //print_r($result[0]['adminpassword']);
        //echo '<br>';
        //print_r(md5($password));
      
        if (!empty($result))
        {
            //if (strtolower($result[0]['adminemail']) == strtolower($username) && base64_decode($result[0]['adminpassword']) == ($password))
            if (strtolower($result[0]['username']) == strtolower($username) && ($result[0]['password']) == (md5($password)) || ($result[0]['password']) == ($password))
            {
                return result;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

}

?>

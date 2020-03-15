<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function user_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query = $this->db->select('username, password')
                          ->where('username', $username)
                          ->where('password', md5($password))
                          ->get('user');

        if($query->num_rows() > 0)
        {
            $session = array(
                'username' => $username,
                'password' => $password,
                'login_status' => TRUE
            );
            
            $this->session->set_userdata($session);

            return true;
            
            
        } else {

            return false;
        }
    }

}

/* End of file Controllername.php */

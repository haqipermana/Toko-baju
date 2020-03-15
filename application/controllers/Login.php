<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');


    }
    public function index()
    {
      if ($this->session->userdata('login_status') == TRUE)
      {
        redirect('home');
      }
      
      else {
        
       $this->load->view('login_view');

      }
    }


    public function act_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == TRUE){

            if($this->Login_model->user_check() == TRUE){

                redirect('home');

            }
            else {
                $this->session->set_flashdata('notif', 'Password dan Username Tidak Benar!');

                redirect('Login');

            }

        } else {
            $this->session->set_flashdata('notif', validation_errors());

            redirect('Login');

        }



       }
       public function logout(){
        $this->session->sess_destroy();

        redirect('Login');
    }

}



/* End of file Controllername.php */

<?php
defined('BASEPATH') or exit('No direct script access allowed');


class LoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function performLoginAjax()
    {

        if ($this->input->post()) {


            $adminID = $this->input->post('adminID');
            $password = $this->input->post('password');


            $isVerified = $this->LoginModel->verifyLogin($adminID, $password);
            echo $isVerified;
        }

    }

    
    public function loadview()
    { {
            $this->load->view('admin/LoginView.php');
        }
    }
     

}

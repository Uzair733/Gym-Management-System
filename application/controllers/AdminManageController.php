<?php
defined('BASEPATH') or exit('No direct script access allowed');


class AdminManageController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function loadview()
    { {
            $this->load->view('admin/AdminCreateView.php');
        }
    }

    public function saveAdmin()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'admin_id' => $this->input->post('adminID'),
            '' => $this->input->post('age')
        );

        $response = $this->AdminModel->insertAdmin($data);

        echo $response;
    }
    
    public function updatingAdmin()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'admin_id' => $this->input->post('adminID'),
            'age' => $this->input->post('age')
        );

        $response = $this->AdminModel->updateAdmin($data);

        echo $response;
    } 
    public function retriveData()
    {

        $response = $this->AdminModel->retrieveAdmin();
          

        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        } 
        echo (json_encode($data));

    }
    public function deleteAdmin()
    {

        $adminID = $this->input->post('postedData');
        if (isset($adminID) && $adminID != null) {
            $response = $this->AdminModel->delAdmin($adminID);
            echo json_encode($response);
        } else {
            echo json_encode("No Admin ID provided");
        }

    }

    public function showoldData()
    {
        $adminID = $this->input->post('postedData');
        $response = $this->AdminModel->getoldAdmin($adminID);
       
        

        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        }
        echo json_encode($data);
    }

}

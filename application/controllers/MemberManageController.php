<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MemberManageController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MemberModel');
    }

    public function loadview()
    { {
            $this->load->view('member/MemberCreateView.php');
        }
    }

    public function saveMember()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'member_id' => $this->input->post('memberID'),
            'address' => $this->input->post('address'),
            'age' => $this->input->post('age'),
            'city' => $this->input->post('city'),
            'package' => $this->input->post('package')
        );

        $response = $this->MemberModel->insertMember($data);

        echo $response;
    }

    public function updatingMember()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'member_id' => $this->input->post('memberID'),
            'address' => $this->input->post('address'),
            'age' => $this->input->post('age'),
            'city' => $this->input->post('city'),
            'package' => $this->input->post('package')
        );

        $response = $this->MemberModel->updateMember($data);

        echo $response;
    }
    public function retriveData()
    {

        $response = $this->MemberModel->retrieveMember();
    

        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        }
        echo (json_encode($data));

    }
    public function deleteMember()
    {

        $memberID = $this->input->post('postedData');
       
        if (isset($memberID) && $memberID != null) {
            $response = $this->MemberModel->delMember($memberID);
            echo json_encode($response);
        } else {
            echo json_encode("No Member ID provided");
        }

    }

    public function showoldData()
    {
        $memberID = $this->input->post('postedData');
        $response = $this->MemberModel->getoldMember($memberID);



        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        }
        echo json_encode($data);
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');


class TrainerManageController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TrainerModel');
    }

    public function loadview()
    { {
            $this->load->view('trainer/TrainerCreateView.php');
        }
    }

    public function saveTrainer()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'trainer_id' => $this->input->post('trainerID'),
            'password' => $this->input->post('password')
        );

        $response = $this->TrainerModel->insertTrainer($data);

        echo $response;
    }
    
    public function updatingTrainer()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'contact' => $this->input->post('contact'),
            'trainer_id' => $this->input->post('trainerID'),
            'password' => $this->input->post('password')
        );

        $response = $this->TrainerModel->updateTrainer($data);

        echo $response;
    }
    public function retriveData()
    {

        $response = $this->TrainerModel->retrieveTrainer();
     
        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        }
        echo (json_encode($data));

    }
    public function deleteTrainer()
    {

        $trainerID = $this->input->post('postedData');
        if (isset($trainerID) && $trainerID != null) {
            $response = $this->TrainerModel->delTrainer($trainerID);
            echo json_encode($response);
        } else {
            echo json_encode("No Trainer ID provided");
        }

    }

    public function showoldData()
    {
        $trainerID = $this->input->post('postedData');
        $response = $this->TrainerModel->getoldTrainer($trainerID);
       
        

        if ($response->num_rows() > 0) {
            $data = $response->result_array();
        }
        echo json_encode($data);
    }

}

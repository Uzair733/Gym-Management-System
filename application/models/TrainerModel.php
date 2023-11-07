<?php
class TrainerModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertTrainer($data)
    {

        $query = "INSERT INTO `trainer`( `name`, `contact`, `trainer_id`, `age`,`date_time`,`operator`,`status`) VALUES ('$data[name]','$data[contact]','$data[trainer_id]','$data[age]',now(),'uzair.abdullah','active')";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Trainer created successfully.';
        } else {
            return 'Failed to create Trainer.';
        }
    }
    public function updateTrainer($data)
    {

        $query = "UPDATE `trainer` SET `name`='$data[name]',`contact`='$data[contact]',`trainer_id`='$data[trainer_id]',`age`='$data[age]',`change_date`=now()  WHERE status='active' AND trainer_id='$data[trainer_id]'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Trainer updated successfully.';
        } else {
            return 'Failed to update Trainer.';
        }
    }

    public function retrieveTrainer()
    {
        $query = "SELECT  `name`, `contact`, `trainer_id`, `operator`, `date_time` FROM `trainer` WHERE STATUS='active'";
        $result = $this->db->query($query);
        
        return ($result);

    }

    public function delTrainer($trainerID)
    {

        $query = "UPDATE `trainer` SET `status`='inactive' WHERE trainer_id='$trainerID' and status ='active'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'success';
        } else {
            return 'failure';
        }
    }
    public function getoldTrainer($trainerID)
    {    
        $query = "SELECT  `name`, `contact`, `trainer_id`, `age` FROM `trainer` WHERE STATUS='active' AND trainer_id='$trainerID'";
        $result = $this->db->query($query);
        return ($result);
    }

}
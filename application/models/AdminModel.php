<?php
class AdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertAdmin($data)
    {

        $query = "INSERT INTO `admin`( `name`, `contact`, `admin_id`, `password`,`date_time`,`operator`) VALUES ('$data[name]','$data[contact]','$data[admin_id]','$data[password]',now(),'uzair.abdullah')";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Admin created successfully.';
        } else {
            return 'Failed to create admin.';
        }
    } 
    public function updateAdmin($data)
    {

        $query = "UPDATE `admin` SET `name`='$data[name]',`contact`='$data[contact]',`admin_id`='$data[admin_id]',`password`='$data[password]',`change_date`=now()  WHERE status='active' AND admin_id='$data[admin_id]'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Admin updated successfully.';
        } else {
            return 'Failed to update admin.';
        }
    }

    public function retrieveAdmin()
    {
        $query = "SELECT  `name`, `contact`, `admin_id`, `operator`, `date_time` FROM `admin` WHERE STATUS='active'";
        $result = $this->db->query($query);
        
        return ($result);

    }

    public function delAdmin($adminID)
    {

        $query = "UPDATE `admin` SET `status`='inactive' WHERE admin_id='$adminID' and status ='active'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'success';
        } else {
            return 'failure';
        }
    }
    public function getoldAdmin($adminID)
    {    
        $query = "SELECT  `name`, `contact`, `admin_id`, `password` FROM `admin` WHERE STATUS='active' AND admin_id='$adminID'";
        $result = $this->db->query($query);
        return ($result);
    }

}
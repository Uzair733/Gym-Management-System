<?php
class LoginModel extends CI_Model {

public function __construct() {
    parent::__construct();
    $this->load->database();
}

public function verifyLogin($adminID, $password) {
     $query = "SELECT COUNT(*) AS COUNT FROM `admin` WHERE admin_id='$adminID' AND password='$password' AND status ='active'";
    $result = $this->db->query($query)->result_array();  
   
    $verified=$result[0]['COUNT'];
    return $verified;
    


}
}
<?php
class MemberModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertMember($data)
    {

        $query = "INSERT INTO `member`( `name`, `contact`, `member_id`, `address`,`age` ,`city`,`package`,`status`,`date_time`,`operator`) VALUES ('$data[name]','$data[contact]','$data[member_id]','$data[address]','$data[age]','$data[city]','$data[package]','active',now(),'operator')";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Member created successfully.';
        } else {
            return 'Failed to create Member.';
        }
    }
    public function updateMember($data)
    {

        $query = "UPDATE `member` SET `name`='$data[name]',`contact`='$data[contact]',`address`='$data[address]',`member_id`='$data[member_id]',`package`='$data[package]',`age`='$data[age]',`city`='$data[city]',`change_date`=now()  WHERE status='active' AND member_id='$data[member_id]'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'Member updated successfully.';
        } else {
            return 'Failed to update member.';
        }
    }

    public function retrieveMember()
    {
        $query = "SELECT  `name`, `contact`, `address`,`age`,`city`,`member_id`,`package`, `operator`, `date_time` FROM `member` WHERE STATUS='active'";
        $result = $this->db->query($query);
        
        return ($result);

    }

    public function delMember($memberID)
    {

        $query = "UPDATE `member` SET `status`='inactive' WHERE member_id='$memberID' and status ='active'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return 'success';
        } else {
            return 'failure';
        }
    }
    public function getoldMember($memberID)
    {    
        $query = "SELECT `name`, `contact`, `member_id`,`address`,`age`,`city`, `package` FROM `member` WHERE STATUS='active' AND member_id='$memberID'";
        $result = $this->db->query($query);
        return ($result);
    }

}
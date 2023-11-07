<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class DashboardController  extends CI_Controller {

  
    public function loadview()  
{ 
	{
		$this->load->view('dashboard/DashboardView.php');
	}
}
}

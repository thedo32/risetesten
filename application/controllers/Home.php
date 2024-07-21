<?php
use GeoIp2\Database\Reader;

 class Home extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Mhome');
		$this->load->helper('url');
		
	
               
		/*
		if($this->session->userdata('status') != "login"){

			redirect(base_url("login"));

            } */

    }
	
    function index(){

		// Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();

		if ($this->session->userdata("name") != Null ){
			$user_id = $user_id = $this->session->userdata("id");
		}else{
			$user_id = 0;
		}

		$art_id=0;
		$title="Home Eng";
	    $this->Mhome->increment_hit_count($title, $user_id, $art_id, $ip_address);



		$this->load->view('view_header');
		$this->load->view('vhome');
		$this->load->view('view_footer');
     }

}

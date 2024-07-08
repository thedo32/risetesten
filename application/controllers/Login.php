<?php

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('mlogin'); // Ensure the mlogin model is loaded
        $this->load->library('form_validation'); // Load form validation library
        $this->load->helper('form'); // Load form helper
        $this->load->library('session'); // Load session library
		$this->load->helper('url'); //load url helper
    }

	//load index page
    function index() {
		$this->load->view('view_header');
        $this->load->view('vlogin');
		$this->load->view('view_footer');
    }

	//load login action
    public function actionlogin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Fetch user from database
        $user = $this->mlogin->get_user_by_username($username); // Use $this->mlogin

        // Verify password
        if ($user && password_verify($password, $user->password)) {
            // Set session data
            $data_session = array(
                'name' => $username,
                'status' => "login"
            );

            $this->session->set_userdata($data_session);

            //to home page
			redirect(base_url('home'));
		
        } else {
            // Invalid credentials
			$this->session->set_tempdata('error_login', 'Invalid username or password, Login again or register');
			
			
            //to login page
			$this->load->view('view_header');
			$this->load->view('vlogin');
			$this->load->view('view_footer');


        }
    }

    function logout() {
			$this->session->sess_destroy();
			
			//to login page
			$this->load->view('view_header');
			$this->load->view('vlogin');
			$this->load->view('view_footer');
    }
}

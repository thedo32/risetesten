<?php

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Mlogin'); // Ensure the Mlogin model is loaded
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
        $user = $this->Mlogin->get_user_by_username($username); // Use $this->Mlogin

        // Verify password
        if ($user && password_verify($password, $user->password)) {
            // Set session data
            $data_session = array(
				'id' => $user->id,
				'name' => $user->name,
                'username' => $username,
                'status' => "login"
            );

            $this->session->set_userdata($data_session);

	
			// Update user's session_id in the database
				$this->db->where('id', $user->id);
				$this->db->update('users', array('session_id' => session_id()));

            //to home page
			redirect(base_url('home'));
		
        } else {
            // Invalid credentials
			$this->session->set_tempdata('error_login', 'Invalid username or password, Login again or register');
			
			$this->session->sess_destroy();

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

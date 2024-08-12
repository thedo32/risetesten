<?php

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Mhome'); // Ensure the Mhome model is loaded - for hit count
      	$this->load->model('Mlogin'); // Ensure the Mlogin model is loaded
        $this->load->library('form_validation'); // Load form validation library
        $this->load->helper('form'); // Load form helper
        $this->load->library('session'); // Load session library
        $this->load->helper('url'); // Load URL helper
    }

    // Load index page
    function index() {
		// Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();
        $referrer = $this->input->server('HTTP_REFERER');


		$utm_params = array(
            'utm_source' => $this->input->get('utm_source'),
            'utm_medium' => $this->input->get('utm_medium'),
            'utm_campaign' => $this->input->get('utm_campaign'),
            'utm_term' => $this->input->get('utm_term'),
            'utm_content' => $this->input->get('utm_content')
        );

        $user_id = $this->session->userdata("name") != null ? $this->session->userdata("id") : 0;

        $art_id = 0;
        $title = "Login Eng";
        $this->Mhome->increment_hit_count($title, $user_id, $art_id, $ip_address, $referrer, $utm_params);

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


    // Load api login action
    public function apilogin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Fetch user from database
        $user = $this->Mlogin->get_user_by_username($username);

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

            $response = array(
                'status' => 'success',
                'message' => 'Login successful',
                'data' => array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $username,
                    'session_id' => session_id()
                )
            );

            // Redirect to home page
            echo json_encode($response);
            exit(); // Ensure no further code is executed after sending the response

        } else {
            // Handle login failure
            if (/* some condition indicating that web login is necessary */ false) {
                $response = array(
                    'status' => 'web_login',
                    'message' => 'Please log in through the website.',
                    'redirect_url' => base_url('login') // URL to the web-based login page
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Invalid username or password'
                );
            }

            echo json_encode($response);
            exit(); // Ensure no further code is executed after sending the response
        }
    }

    function logout() {
        // Fetch user ID from session
        $user_id = $this->session->userdata('id');

        if ($user_id) {
            // Clear session data in database
            $this->db->where('id', $user_id);
            $this->db->update('users', array('session_id' => NULL));

            // Destroy the session
            $this->session->sess_destroy();
        }

        // Redirect to login page
        $this->load->view('view_header');
        $this->load->view('vlogin');
        $this->load->view('view_footer');
    }
}

<?php

use GeoIp2\Database\Reader;

class Taluak extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mtaluak');
        $this->load->library('pagination');
		$this->load->helper('url');

		$this->load->library('form_validation'); // Load form validation library
        $this->load->helper('form'); // Load form helper
		$this->load->helper('text'); // Load text helper
    }


	//check if user login
	/* private function check_login() {
        if (!$this->session->userdata('status') || $this->session->userdata('status') != 'login') {
            redirect('login'); // Redirect to login page if not logged in
        }
    } 
	*/


    public function add() {
        // Check if form submitted
		 
      if ($this->input->post()) {
            // Form validation rules
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[taluak.title]');
            $this->form_validation->set_rules('text', 'Text', 'required');

            // If form validation succeeds
            if ($this->form_validation->run() == TRUE) {
                // Get form data

				$slug = url_title($this->input->post('title'), 'dash', TRUE);
                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => $slug,
                    'text' => $this->input->post('text')
                );

                // Add taluak to database
                $this->Mtaluak->add_taluak($data);

				// temporary notification after add success
				$this->session->set_tempdata('add_success','Berita baru berhasil ditambahkan', 15);

                // Redirect to user list page
                redirect('taluak/index');
				
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddtaluak');
		$this->load->view('view_footer');
    }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get taluak data by id
    $taluak = $this->Mtaluak->get_taluak($id);

    // If taluak not found
    if (!$taluak) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $taluak->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[taluak.title]');
		endif;
		$this->form_validation->set_rules('text', 'Text', 'required');

        // If form validation succeeds

        if ($this->form_validation->run() == TRUE) {
            // Get form data
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
				'text' => $this->input->post('text')
            );

            // Update taluak in database
            $this->Mtaluak->edit_taluak($id, $data);

			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

            // Redirect to taluak list page
            redirect('taluak/index');
        }
    }

    // Pass taluak data to view
    $data['taluak'] = $taluak;

    // Load edit taluak view
	$this->load->view('view_header');
    $this->load->view('vedittaluak', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if taluak id is provided
        if (!$id) {
            show_404();
        }

        // Delete taluak from database
        $this->Mtaluak->delete_taluak($id);

        // Redirect to taluak list page
        redirect('taluak/index');
    }

    public function index() {

		 // $this->check_login(); // Check if taluak is logged in

	 // Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();

		if ($this->session->userdata("name") != Null ){
			$user_id = $user_id = $this->session->userdata("id");
		}else{
			$user_id = 0;
		}

		$art_id=0;
		$title="Tour";
	    $this->Mtaluak->increment_hit_count($title, $user_id, $art_id, $ip_address);

    // Pagination configuration
		$config['base_url'] = base_url('taluak/index');
		$config['total_rows'] = $this->Mtaluak->get_total_taluak();
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;

    // Additional pagination settings for better display
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';

		$this->pagination->initialize($config);

    // Get taluak with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['taluak'] = array(); // Initialize as empty array
		$data['taluak'] = $this->Mtaluak->get_taluak_taluak($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched taluak data: ' . print_r($data['taluak'], true));


    // Load taluak list view
		$this->load->view('view_header');
		$this->load->view('vtaluaklist', $data);
		$this->load->view('view_footer');
	}


	// View the taluak 
	public function view($slug = NULL){
        $data['taluak'] = $this->Mtaluak->get_taluak_view($slug);

        if (empty($data['taluak']))
        {
                show_404();
        }

		 // Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();

		if ($this->session->userdata("name") != Null ){
			$user_id = $user_id = $this->session->userdata("id");
		}else{
			$user_id = 0;
		}
		
		$title = $data['taluak']->title;
	    $this->Mtaluak->increment_hit_count($title, $user_id, $data['taluak']->id, $ip_address);



		// Get city and country based on IP address
        require_once 'vendor/autoload.php';
        $reader = new Reader('extension/db/GeoLite2-City.mmdb');
        try {
            $record = $reader->city($ip_address);
            $data['city'] = $record->city->name;
            $data['country'] = $record->country->name;
        } catch (Exception $e) {
            $data['city'] = 'Unknown';
            $data['country'] = 'Unknown';
        }


        // $data['title'] = $data['taluak_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vtaluak', $data);
		$this->load->view('view_footer');
   
	}

}

<?php

use GeoIp2\Database\Reader;

class Padang extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mpadang');
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
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[padang.title]');
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

                // Add padang to database
                $this->Mpadang->add_padang($data);

				// temporary notification after add success
				$this->session->set_tempdata('add_success','Berita baru berhasil ditambahkan', 15);

                // Redirect to user list page
                redirect('padang/index');
				
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddpadang');
		$this->load->view('view_footer');
    }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get padang data by id
    $padang = $this->Mpadang->get_padang($id);

    // If padang not found
    if (!$padang) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $padang->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[padang.title]');
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

            // Update padang in database
            $this->Mpadang->edit_padang($id, $data);

			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

            // Redirect to padang list page
            redirect('padang/index');
        }
    }

    // Pass padang data to view
    $data['padang'] = $padang;

    // Load edit padang view
	$this->load->view('view_header');
    $this->load->view('veditpadang', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if padang id is provided
        if (!$id) {
            show_404();
        }

        // Delete padang from database
        $this->Mpadang->delete_padang($id);

        // Redirect to padang list page
        redirect('padang/index');
    }

    public function index() {

		 // $this->check_login(); // Check if padang is logged in

		 // Increment hit count
        $this->load->library('user_agent');
        $ip_address = $this->input->ip_address();

		if ($this->session->userdata("name") != Null ){
			$user_id = $user_id = $this->session->userdata("id");
		}else{
			$user_id = 0;
		}

		$art_id=0;
		$title="Cafe";
	    $this->Mpadang->increment_hit_count($title, $user_id, $art_id, $ip_address);


    // Pagination configuration
		$config['base_url'] = base_url('padang/index');
		$config['total_rows'] = $this->Mpadang->get_total_padang();
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

    // Get padang with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['padang'] = array(); // Initialize as empty array
		$data['padang'] = $this->Mpadang->get_padang_padang($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched padang data: ' . print_r($data['padang'], true));


    // Load padang list view
		$this->load->view('view_header');
		$this->load->view('vpadanglist', $data);
		$this->load->view('view_footer');
	}


	// View the padang 
	public function view($slug = NULL){
        $data['padang'] = $this->Mpadang->get_padang_view($slug);

        if (empty($data['padang']))
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
		
		$title=$data['padang']->title;
	    $this->Mpadang->increment_hit_count($title, $user_id, $data['padang']->id, $ip_address);



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


        // $data['title'] = $data['padang_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vpadang', $data);
		$this->load->view('view_footer');
   
	}

}

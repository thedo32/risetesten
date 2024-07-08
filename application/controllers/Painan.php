<?php
class Painan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mpainan');
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
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[painan.title]');
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

                // Add painan to database
                $this->Mpainan->add_painan($data);

				// temporary notification after add success
				$this->session->set_tempdata('add_success','Berita baru berhasil ditambahkan', 15);

                // Redirect to user list page
                redirect('painan/index');
				
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddpainan');
		$this->load->view('view_footer');
    }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get painan data by id
    $painan = $this->Mpainan->get_painan($id);

    // If painan not found
    if (!$painan) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $painan->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[painan.title]');
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

            // Update painan in database
            $this->Mpainan->edit_painan($id, $data);

			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

            // Redirect to painan list page
            redirect('painan/index');
        }
    }

    // Pass painan data to view
    $data['painan'] = $painan;

    // Load edit painan view
	$this->load->view('view_header');
    $this->load->view('veditpainan', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if painan id is provided
        if (!$id) {
            show_404();
        }

        // Delete painan from database
        $this->Mpainan->delete_painan($id);

        // Redirect to painan list page
        redirect('painan/index');
    }

    public function index() {

		 // $this->check_login(); // Check if painan is logged in

    // Pagination configuration
		$config['base_url'] = base_url('painan/index');
		$config['total_rows'] = $this->Mpainan->get_total_painan();
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

    // Get painan with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['painan'] = array(); // Initialize as empty array
		$data['painan'] = $this->Mpainan->get_painan_painan($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched painan data: ' . print_r($data['painan'], true));


    // Load painan list view
		$this->load->view('view_header');
		$this->load->view('vpainanlist', $data);
		$this->load->view('view_footer');
	}


	// View the painan 
	public function view($slug = NULL){
        $data['painan'] = $this->Mpainan->get_painan_view($slug);

        if (empty($data['painan']))
        {
                show_404();
        }

        // $data['title'] = $data['painan_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vpainan', $data);
		$this->load->view('view_footer');
   
	}

}

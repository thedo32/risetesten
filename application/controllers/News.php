<?php
class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mnews');
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
            $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
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

                // Add news to database
                $this->Mnews->add_news($data);

				// temporary notification after add success
				$this->session->set_tempdata('add_success','Berita baru berhasil ditambahkan', 15);

                // Redirect to user list page
                redirect('news/index');
				
            }
        }

        // Load add user view
		$this->load->view('view_header');
        $this->load->view('vaddnews');
		$this->load->view('view_footer');
    }

    public function edit($id) {
    // Check if user id is provided
    if (!$id) {
        show_404();
    }

    // Get news data by id
    $news = $this->Mnews->get_news($id);

    // If news not found
    if (!$news) {
        show_404();
    }

    // Check if form submitted
    if ($this->input->post()) {
        // Form validation rules

		if ($this->input->post('title') === $news->title): 
			$this->form_validation->set_rules('title', 'Title', 'required');
       	else:
		   $this->form_validation->set_rules('title', 'Title', 'required|is_unique[news.title]');
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

            // Update news in database
            $this->Mnews->edit_news($id, $data);

			// temporary notification after edit success
				$this->session->set_tempdata('edit_success','Berita berhasil diupdate', 15);

            // Redirect to news list page
            redirect('news/index');
        }
    }

    // Pass news data to view
    $data['news'] = $news;

    // Load edit news view
	$this->load->view('view_header');
    $this->load->view('veditnews', $data);
	$this->load->view('view_footer');
}


    public function delete($id) {
        // Check if news id is provided
        if (!$id) {
            show_404();
        }

        // Delete news from database
        $this->Mnews->delete_news($id);

        // Redirect to news list page
        redirect('news/index');
    }

    public function index() {

		 // $this->check_login(); // Check if news is logged in

    // Pagination configuration
		$config['base_url'] = base_url('news/index');
		$config['total_rows'] = $this->Mnews->get_total_news();
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

    // Get news with pagination
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['news'] = array(); // Initialize as empty array
		$data['news'] = $this->Mnews->get_news_news($config['per_page'], $page);
		// Log the fetched data for debugging
		log_message('debug', 'Fetched news data: ' . print_r($data['news'], true));


    // Load news list view
		$this->load->view('view_header');
		$this->load->view('vnewslist', $data);
		$this->load->view('view_footer');
	}


	// View the news 
	public function view($slug = NULL){
        $data['news'] = $this->Mnews->get_news_view($slug);

        if (empty($data['news']))
        {
                show_404();
        }

        // $data['title'] = $data['news_item']['title'];

		$this->load->view('view_header');
        $this->load->view('vnews', $data);
		$this->load->view('view_footer');
   
	}

}

<?php
class Mnews extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_news($data) {
        return $this->db->insert('news', $data);
    }

    // Get news by ID
     public function get_news($id) {
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_news_view($slug) {
		$query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_news($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('news', $data);
    }

    // Delete news from the database
    public function delete_news($id) {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }

    // Get total number of news
    public function get_total_news() {
        return $this->db->count_all('news');
    }

    // Get news with pagination
    public function get_news_news($limit, $offset) {
		$this->db->order_by('updated_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('news');
        return $query->result_array();
    }

	
}

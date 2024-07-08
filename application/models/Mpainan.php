<?php
class Mpainan extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_painan($data) {
        return $this->db->insert('painan', $data);
    }

    // Get news by ID
     public function get_painan($id) {
        $query = $this->db->get_where('painan', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_painan_view($slug) {
		$query = $this->db->get_where('painan', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_painan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('painan', $data);
    }

    // Delete news from the database
    public function delete_painan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('painan');
    }

    // Get total number of news
    public function get_total_painan() {
        return $this->db->count_all('painan');
    }

    // Get news with pagination
    public function get_painan_painan($limit, $offset) {
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('painan');
        return $query->result_array();
    }

	
}

<?php
class Mpadang extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_padang($data) {
        return $this->db->insert('padang', $data);
    }

    // Get news by ID
     public function get_padang($id) {
        $query = $this->db->get_where('padang', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_padang_view($slug) {
		$query = $this->db->get_where('padang', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_padang($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('padang', $data);
    }

    // Delete news from the database
    public function delete_padang($id) {
        $this->db->where('id', $id);
        return $this->db->delete('padang');
    }

    // Get total number of news
    public function get_total_padang() {
        return $this->db->count_all('padang');
    }

    // Get news with pagination
    public function get_padang_padang($limit, $offset) {
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('padang');
        return $query->result_array();
    }

	
}

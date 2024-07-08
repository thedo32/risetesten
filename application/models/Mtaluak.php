<?php
class Mtaluak extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_taluak($data) {
        return $this->db->insert('taluak', $data);
    }

    // Get news by ID
     public function get_taluak($id) {
        $query = $this->db->get_where('taluak', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_taluak_view($slug) {
		$query = $this->db->get_where('taluak', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_taluak($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('taluak', $data);
    }

    // Delete news from the database
    public function delete_taluak($id) {
        $this->db->where('id', $id);
        return $this->db->delete('taluak');
    }

    // Get total number of news
    public function get_total_taluak() {
        return $this->db->count_all('taluak');
    }

    // Get news with pagination
    public function get_taluak_taluak($limit, $offset) {
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('taluak');
        return $query->result_array();
    }

	
}

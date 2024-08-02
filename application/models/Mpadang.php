<?php

use GeoIp2\Database\Reader;

class Mpadang extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_padang($data) {
        return $this->db->insert('padangen', $data);
    }

    // Get news by ID
     public function get_padang($id) {
        $query = $this->db->get_where('padangen', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_padang_view($slug) {
		$query = $this->db->get_where('padangen', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_padang($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('padangen', $data);
    }

    // Delete news from the database
    public function delete_padang($id) {
        $this->db->where('id', $id);
        return $this->db->delete('padangen');
    }

    // Get total number of news
    public function get_total_padang() {
        return $this->db->count_all('padangen');
    }

    // Get news with pagination
    public function get_padang_padang($limit, $offset) {
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('padangen');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer) {
        
		 // Increment the hit count in the taluak table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluak');
    }	
}

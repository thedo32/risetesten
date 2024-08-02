<?php

use GeoIp2\Database\Reader;

class Mpainan extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_painan($data) {
        return $this->db->insert('painanen', $data);
    }

    // Get news by ID
     public function get_painan($id) {
        $query = $this->db->get_where('painanen', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_painan_view($slug) {
		$query = $this->db->get_where('painanen', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_painan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('painanen', $data);
    }

    // Delete news from the database
    public function delete_painan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('painanen');
    }

    // Get total number of news
    public function get_total_painan() {
        return $this->db->count_all('painanen');
    }

    // Get news with pagination
    public function get_painan_painan($limit, $offset) {
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('painanen');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer) {
        
		 // Increment the hit count in the taluak table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluak');
    }	
}

<?php

use GeoIp2\Database\Reader;

class Mtaluak extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add news to the database
    public function add_taluak($data) {
        return $this->db->insert('taluaken', $data);
    }

    // Get news by ID
     public function get_taluak($id) {
        $query = $this->db->get_where('taluaken', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

	// Get news by slug
     public function get_taluak_view($slug) {
		$query = $this->db->get_where('taluaken', array('slug' => $slug));
        return $query->row(); // Fetch the row as an object
    }

    // Update news in the database
    public function edit_taluak($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('taluaken', $data);
    }

    // Delete news from the database
    public function delete_taluak($id) {
        $this->db->where('id', $id);
        return $this->db->delete('taluaken');
    }

    // Get total number of news
    public function get_total_taluak() {
        return $this->db->count_all('taluaken');
    }

    // Get news with pagination
    public function get_taluak_taluak($limit, $offset) {
		$this->db->order_by('updated_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('taluaken');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer) {
        
		 // Increment the hit count in the taluaken table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluaken');
    }	
}

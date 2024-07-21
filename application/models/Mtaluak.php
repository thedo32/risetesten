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
		$this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('taluaken');
        return $query->result_array();
    }


	public function increment_hit_count($title, $user_id, $id, $ip_address) {
    // Check if the IP address has already hit this entry within the last week
    $query = $this->db->get_where('hits', array(
        'art_id' => $id,
        'user_id' => $user_id,
        'title' => $title,
        'ip_address' => $ip_address
    ));

    if ($query->num_rows() == 0 || (strtotime(date('Y-m-d H:i:s')) - strtotime($query->row()->hit_time)) >= 2592000) {
        // Use GeoIP2 library to get city and country
        require_once 'vendor/autoload.php';
        $reader = new Reader('extension/db/GeoLite2-City.mmdb');

        try {
            $record = $reader->city($ip_address);
            $city = $record->city->name;
            $country = $record->country->name;
        } catch (Exception $e) {
            $city = 'Unknown';
            $country = 'Unknown';
        }

        // Insert a new record in the hits table
       if ($this->session->userdata("name") != Null ){
			$user_id = $this->session->userdata("id");
			$data = array(
				'art_id' => $id,
				'user_id' => $user_id,
				'title' => $title,
				'ip_address' => $ip_address,
				'hit_time' => date('Y-m-d H:i:s'),
				'city' => $city,
				'country' => $country,
			);	
		}else{
			$data = array(
				'art_id' => $id,
				'title' => $title,
				'ip_address' => $ip_address,
				'hit_time' => date('Y-m-d H:i:s'),
				'city' => $city,
				'country' => $country,
			);	
		}

        $this->db->insert('hits', $data);

		 // Increment the hit count in the taluak table
         //$this->db->where('id', $id);
         //$this->db->set('hit_count', 'hit_count+1', FALSE);
         //$this->db->update('taluaken');
        }
    }	
}

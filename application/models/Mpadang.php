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

		  // Increment the hit count in the padang table
          //$this->db->where('id', $id);
          //$this->db->set('hit_count', 'hit_count+1', FALSE);
          //$this->db->update('padangen');
        }
    }	
}

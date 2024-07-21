<?php

use GeoIp2\Database\Reader;

class Mhome extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
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

		    // Increment the hit count in the painan table
            //$this->db->where('id', $id);
            //$this->db->set('hit_count', 'hit_count+1', FALSE);
            //$this->db->update('painan');
        }
    }	
}

<?php

use GeoIp2\Database\Reader;

class Mhome extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();  // Load the database library
    }

    public function increment_hit_count($title, $user_id, $id, $ip_address, $referrer, $utm_params,$agent) {
        // Check if the IP address has already hit this entry within the last month
        $query = $this->db->get_where('hits', array(
            'art_id' => $id,
            'user_id' => $user_id,
            'title' => $title,
			'agent' => $agent,
            'ip_address' => $ip_address
        ));

        // Condition: If no record or the last hit was more than 30 days ago
        if ($query->num_rows() == 0 || (strtotime(date('Y-m-d H:i:s')) - strtotime($query->row()->hit_time)) >= 2592000) {
            // Use GeoIP2 library to get city, country, and coordinates
            require_once 'vendor/autoload.php';

            try {
                $reader = new Reader('extension/db/GeoLite2-City.mmdb');
                $record = $reader->city($ip_address);

                $city = $record->city->name ?? 'Other';
                $country = $record->country->name ?? 'Other';

                // Get latitude and longitude
                $latitude = $record->location->latitude ?? 0.0;
                $longitude = $record->location->longitude ?? 0.0;

                // Debugging logs
                error_log("IP: $ip_address, City: $city, Country: $country, Latitude: $latitude, Longitude: $longitude");
            } catch (Exception $e) {
                error_log("GeoIP Error: " . $e->getMessage());
                $city = 'Other';
                $country = 'Other';
                $latitude = 0.0;
                $longitude = 0.0;
            }

            // Insert a new record in the hits table
            $data = array(
                'art_id' => $id,
                'user_id' => $user_id,
                'title' => $title,
                'ip_address' => $ip_address,
                'hit_time' => date('Y-m-d H:i:s'),
                'city' => $city,
                'country' => $country,
                'lat' => $latitude, // Add latitude
                'lon' => $longitude, // Add longitude
                'referrer' => $referrer,
                'utm_source' => isset($utm_params['utm_source']) ? $utm_params['utm_source'] : null,
                'utm_medium' => isset($utm_params['utm_medium']) ? $utm_params['utm_medium'] : null,
                'utm_campaign' => isset($utm_params['utm_campaign']) ? $utm_params['utm_campaign'] : null,
                'utm_term' => isset($utm_params['utm_term']) ? $utm_params['utm_term'] : null,
                'utm_content' => isset($utm_params['utm_content']) ? $utm_params['utm_content'] : null,
                'agent' => $agent,
            );

            $this->db->insert('hits', $data);


		    // Increment the hit count in the painan table
            //$this->db->where('id', $id);
            //$this->db->set('hit_count', 'hit_count+1', FALSE);
            //$this->db->update('painan');
        }
    }

public function bulk_update_coordinates()
    {
        // Fetch all records where latitude and longitude are missing (0.0)
        $query = $this->db->get_where('hits', array('lat' => 0.0, 'lon' => 0.0));

        if ($query->num_rows() > 0) {
            require_once 'vendor/autoload.php';
            $reader = new Reader('extension/db/GeoLite2-City.mmdb');

            foreach ($query->result() as $row) {
                $ip_address = $row->ip_address;
                $id = $row->id;

                try {
                    $record = $reader->city($ip_address);
                    $latitude = $record->location->latitude ?? 0.0;
                    $longitude = $record->location->longitude ?? 0.0;

                    // Update the record with coordinates
                    $this->db->where('id', $id);
                    $this->db->update('hits', array('lat' => $latitude, 'lon' => $longitude));

                    // Debugging log
                    error_log("Updated ID: $id, IP: $ip_address, Latitude: $latitude, Longitude: $longitude");
                } catch (Exception $e) {
                    error_log("GeoIP Error for ID $id: " . $e->getMessage());
                }
            }
        } else {
            error_log("No records found for bulk coordinate update.");
        }
    }
}

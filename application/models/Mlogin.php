<?php
 

class Mlogin extends CI_Model{   

	public function get_user_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row(); // Return the row as an object
    }

}

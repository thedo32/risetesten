<?php
class Muser extends CI_Model {

    public function __construct() {
        parent::__construct();
       
        $this->load->database();  // Load the database library
    }

    // Add user to the database
    public function add_user($data) {
        return $this->db->insert('users', $data);
    }

    // Get user by ID
     public function get_user($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row(); // Fetch the row as an object
    }

    // Update user in the database
    public function edit_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Delete user from the database
    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    // Get total number of users
    public function get_total_users() {
        return $this->db->count_all('users');
    }

    // Get users with pagination
    public function get_users($limit, $offset) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('users');
        return $query->result_array();
    }

	//Get user to check the name already taken or not
	public function get_user_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row(); // Return the row as an object
    }


}

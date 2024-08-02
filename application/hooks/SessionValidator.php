<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SessionValidator {
    public function validate() {
        // Get the CodeIgniter instance
        $CI =& get_instance();
        
        // Load necessary libraries and models
        $CI->load->library('session');
        $CI->load->model('User_model');
        
        // Check session
        $user_id = $CI->session->userdata('id');
        if ($user_id) {
            $user = $CI->User_model->get_user($user_id);
            if ($user && $user->session_id !== session_id()) {
                // Session ID does not match, log the user out
                $CI->session->sess_destroy();
                $CI->session->set_flashdata('error', 'Your session has expired. Please log in again.');
                redirect('login');
            }
        }
    }
}

<?php

class UsersModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserData(string $userLogin): ?stdClass
    {
        $result = $this->db
            ->select('user_id, password_hash, user_full_name, user_email')
            ->from('users')
            ->where('user_login', $userLogin)
            ->get();

        if ($result->num_rows() > 0) {
            return $result->row();
        }
        return null;
    }
}
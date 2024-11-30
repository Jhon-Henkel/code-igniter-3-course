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

    public function get_data(int $id, string $select = null)
    {
        if (!empty($select)) {
            $this->db->select($select);
        }
        $this->db->from('users');
        $this->db->where('user_id', $id);
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->insert('users', $data);
    }

    public function update(int $id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
    }

    public function delete(int $id, string $select = null)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }

    public function is_duplicated($field, $value, $id = null): bool
    {
        if (!empty($id)) {
            $this->db->where('user_id <>', $id);
        }
        $this->db->from('users');
        $this->db->where($field, $value);
        return $this->db->get()->num_rows() > 0;
    }
}
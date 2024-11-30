<?php

class TeamModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data(int $id, string $select = null)
    {
        if (!empty($select)) {
            $this->db->select($select);
        }
        $this->db->from('team');
        $this->db->where('member_id', $id);
        return $this->db->get();
    }

    public function insert($data)
    {
        $this->db->insert('team', $data);
    }

    public function update(int $id, $data)
    {
        $this->db->where('member_id', $id);
        $this->db->update('team', $data);
    }

    public function delete(int $id, string $select = null)
    {
        $this->db->where('member_id', $id);
        $this->db->delete('team');
    }

    public function is_duplicated($field, $value, $id = null): bool
    {
        if (!empty($id)) {
            $this->db->where('member_id <>', $id);
        }
        $this->db->from('team');
        $this->db->where($field, $value);
        return $this->db->get()->num_rows() > 0;
    }
}
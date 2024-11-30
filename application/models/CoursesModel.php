<?php

class CoursesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data(int $id, string $select = null): CI_DB_result
    {
        if (!empty($select)) {
            $this->db->select($select);
        }
        $this->db->from('courses');
        $this->db->where('course_id', $id);
        return $this->db->get();
    }

    public function insert($data): void
    {
        $this->db->insert('courses', $data);
    }

    public function update(int $id, $data): void
    {
        $this->db->where('course_id', $id);
        $this->db->update('courses', $data);
    }

    public function delete(int $id, string $select = null): void
    {
        $this->db->where('course_id', $id);
        $this->db->delete('courses');
    }

    public function is_duplicated($field, $value, $id = null): bool
    {
        if (!empty($id)) {
            $this->db->where('course_id <>', $id);
        }
        $this->db->from('courses');
        $this->db->where($field, $value);
        return $this->db->get()->num_rows() > 0;
    }
}
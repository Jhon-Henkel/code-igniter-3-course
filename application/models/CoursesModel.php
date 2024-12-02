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

    public function delete(int $id): void
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

    private $columnSearch = ["course_name", "course_description"];
    private $columnOrder = [0 => "course_name", 2 => "course_duration"];

    private function _getDataTable(): void
    {
        $search = null;
        if ($this->input->post('search')) {
            $search = $this->input->post('search')['value'];
        }
        $order = $this->input->post('order');
        $orderColumn = null;
        $orderDir = null;
        if ($order) {
            $orderColumn = $order[0]['column'];
            $orderDir = $order[0]['dir'];
        }
        $this->db->from('courses');
        if ($search) {
            $first = true;
            foreach ($this->columnSearch as $field) {
                if ($first) {
                    $this->db->group_start();
                    $this->db->like($field, $search);
                    $first = false;
                } else {
                    $this->db->or_like($field, $search);
                }
            }
            if (!$first) {
                $this->db->group_end();
            }
        }
        if ($order) {
            $this->db->order_by($this->columnOrder[$orderColumn], $orderDir);
        }
    }

    public function getDataTabe()
    {
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        $this->_getDataTable();
        if (isset($length) && $length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    public function recordsFiltered(): int
    {
        $this->_getDataTable();
        return $this->db->get()->num_rows();
    }

    public function recordsTotal(): int
    {
        return $this->db->count_all_results('courses');
    }

    public function showCourses(): array
    {
        $this->db->from('courses');
        return $this->db->get()->result_array();
    }
}
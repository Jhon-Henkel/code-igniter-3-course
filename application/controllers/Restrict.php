<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{
    const HAS_ERROR = 0;
    const NO_ERROR = 1;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $data = ["scripts" => ["util.js"]];
        if ($this->session->userdata("user_id")) {
            $data["scripts"][] = "restrict.js";
            $this->template->show('restrict', $data);
        } else {
            $data["scripts"][] = "login.js";
            $this->template->show('login', $data);
        }
    }

    public function logoff()
    {
        $this->session->sess_destroy();
        header("Location: " . base_url() . "restrict");
    }

    public function ajax_login()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $json = ["status" => self::HAS_ERROR, "error_list" => []];
        $username = $this->input->post('username');

        if (empty($username)) {
            $json['error_list']['#username'] = "Usuário não pode ser vazio!";
        } else {
            $this->load->model('UsersModel');
            $result = $this->UsersModel->getUserData($username);
            if ($result) {
                if (password_verify($this->input->post('password'), $result->password_hash)) {
                    $json['status'] = self::NO_ERROR;
                    $this->session->set_userdata('user_id', $result->user_id);
                }
            }
        }
        if ($json['status'] === self::HAS_ERROR) {
            $json['error_list']['#btn_login'] = "Usuário ou senha inválidos!";
        }
        echo json_encode($json);
    }

    public function ajax_import_image()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $config = ["upload_path" => "./tmp/", "allowed_types" => "gif|jpg|jpeg|png", "overwrite" => true];
        $this->load->library('upload', $config);

        $json = ["status" => self::HAS_ERROR, "error" => ""];
        if (!$this->upload->do_upload('image_file')) {
            $json['error'] = $this->upload->display_errors('', '');
        } else {
            if ($this->upload->data('file_size') <= 1024) {
                $fileName = $this->upload->data('file_name');
                $json = ["status" => self::NO_ERROR, "image_path" => base_url("tmp/$fileName")];
            } else {
                $json["error"] = "O arquivo não pode ter mais de 1MB!";
            }
        }
        echo json_encode($json);
    }
}

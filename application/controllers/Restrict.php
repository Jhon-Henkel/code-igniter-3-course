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
        $data = [
            "scripts" => [
                "util.js",
                "login.js"
            ]
        ];
        $this->template->show('login', $data);
    }

    public function ajax_login()
    {
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
}

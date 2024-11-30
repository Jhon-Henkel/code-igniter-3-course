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

    protected function validateAjax()
    {
        if (! $this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    protected function getDefaultResponse(): array
    {
        return ["status" => self::HAS_ERROR, "error_list" => [], "error" => ""];
    }

    public function index()
    {
        $data = ["scripts" => ["util.js"]];
        if ($this->session->userdata("user_id")) {
            $data["scripts"][] = "restrict.js";
            $data["user_id"] = $this->session->userdata("user_id");
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
        $this->validateAjax();
        $json = $this->getDefaultResponse();
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
        $this->validateAjax();
        $config = ["upload_path" => "./tmp/", "allowed_types" => "gif|jpg|jpeg|png", "overwrite" => true];
        $this->load->library('upload', $config);

        $json = $this->getDefaultResponse();
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

    public function ajax_save_course()
    {
        $this->validateAjax();
        $json = $this->getDefaultResponse();

        $this->load->model('CoursesModel');
        $data = $this->input->post();

        if (empty($data['course_name'])) {
            $json['error_list']['#course_name'] = "Nome do curso é obrigatório!";
        } else {
            if ($this->CoursesModel->is_duplicated('course_name', $data['course_name'], $data['course_id'])) {
                $json['error_list']['#course_name'] = "Nome do curso já existe!";
            }
        }
        $data['course_duration'] = floatval($data['course_duration']);
        if (empty($data['course_duration'])) {
            $json['error_list']['#course_duration'] = "Duração do curso é obrigatório!";
        } else {
            if (! ($data['course_duration'] > 0 && $data['course_duration'] < 100)) {
                $json['error_list']['#course_duration'] = "Duração do curso tem que ser maior que zero (h) e menor que 100 (h)!";
            }
        }

        if (count($json['error_list']) === 0) {
            $json['status'] = self::NO_ERROR;
        }

        if ($json['status'] === self::NO_ERROR && ! empty($data['course_img'])) {
            $fileName = basename($data['course_img']);
            $oldPath = getcwd() . "/tmp/$fileName";
            $newPath = getcwd() . "/public/images/courses/$fileName";
            rename($oldPath, $newPath);
            $data['course_img'] = "/public/images/courses/$fileName";
        }

        if ($json['status'] === self::HAS_ERROR) {
            echo json_encode($json);
            return;
        }

        if (empty($data['course_id'])) {
            $this->CoursesModel->insert($data);
        } else {
            $this->CoursesModel->update($data['course_id'], $data);
            unset($data['course_id']);
        }

        echo json_encode($json);
    }

    public function ajax_save_member()
    {
        $this->validateAjax();
        $json = $this->getDefaultResponse();

        $this->load->model('TeamModel');
        $data = $this->input->post();

        if (empty($data['member_name'])) {
            $json['error_list']['#member_name'] = "Nome do membro é obrigatório!";
        }

        if (count($json['error_list']) === 0) {
            $json['status'] = self::NO_ERROR;
        }

        if ($json['status'] === self::NO_ERROR && ! empty($data['member_img'])) {
            $fileName = basename($data['member_img']);
            $oldPath = getcwd() . "/tmp/$fileName";
            $newPath = getcwd() . "/public/images/team/$fileName";
            rename($oldPath, $newPath);
            $data['member_img'] = "/public/images/team/$fileName";
        }

        if ($json['status'] === self::HAS_ERROR) {
            echo json_encode($json);
            return;
        }

        $data['member_photo'] = $data['member_img'];
        unset($data['member_img']);
        if (empty($data['member_id'])) {
            $this->TeamModel->insert($data);
        } else {
            $this->TeamModel->update($data['member_id'], $data);
            unset($data['member_id']);
        }

        echo json_encode($json);
    }

    public function ajax_save_user()
    {
        $this->validateAjax();
        $json = $this->getDefaultResponse();

        $this->load->model('UsersModel');
        $data = $this->input->post();

        if (empty($data['user_login'])) {
            $json['error_list']['#user_login'] = "Login é obrigatório!";
        } else {
            if ($this->UsersModel->is_duplicated('user_login', $data['user_login'], $data['user_id'])) {
                $json['error_list']['#user_login'] = "Login já existe!";
            }
        }

        if (empty($data['user_full_name'])) {
            $json['error_list']['#user_full_name'] = "Nome completo é obrigatório!";
        }

        if (empty($data['user_email'])) {
            $json['error_list']['#user_email'] = "E-mail é obrigatório!";
        } else {
            if ($this->UsersModel->is_duplicated('user_email', $data['user_email'], $data['user_id'])) {
                $json['error_list']['#user_email'] = "E-mail já existe!";
            } elseif ($data['user_email'] !== $data['user_email_confirm']) {
                $json['error_list']['#user_email'] = "";
                $json['error_list']['#user_email_confirm'] = "E-mails não conferem!";
            }
        }

        if (empty($data['user_password'])) {
            $json['error_list']['#user_password'] = "Senha é obrigatório!";
        } else {
            if ($data['user_password'] !== $data['user_password_confirm']) {
                $json['error_list']['#user_password'] = "";
                $json['error_list']['#user_password_confirm'] = "Senhas não conferem!";
            }
        }

        if (count($json['error_list']) === 0) {
            $json['status'] = self::NO_ERROR;
        }

        if ($json['status'] === self::HAS_ERROR) {
            echo json_encode($json);
            return;
        }

        $data['password_hash'] = password_hash($data['user_password'], PASSWORD_DEFAULT);
        unset($data['user_password_confirm'], $data['user_email_confirm'], $data['user_password']);
        if (empty($data['member_id'])) {
            $this->UsersModel->insert($data);
        } else {
            $this->UsersModel->update($data['user_id'], $data);
            unset($data['user_id']);
        }

        echo json_encode($json);
    }

    public function ajax_get_user_data()
    {
        $this->validateAjax();

        $this->load->model('UsersModel');
        $userId = $this->input->post('user_id');
        $data = $this->UsersModel->get_data($userId)->result_array()[0];

        $json = $this->getDefaultResponse();
        $json['status'] = self::NO_ERROR;
        $json['input'] = [
            'user_id' => $data['user_id'],
            'user_login' => $data['user_login'],
            'user_full_name' => $data['user_full_name'],
            'user_email' => $data['user_email'],
            'user_email_confirm' => $data['user_email'],
            'user_password' => $data['password_hash'],
            'user_password_confirm' => $data['password_hash']
        ];

        echo json_encode($json);
    }
}

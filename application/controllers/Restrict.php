<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{
    public function index()
    {
        $this->load->model('UsersModel');
        $data = $this->UsersModel->getUserData('admin');

        var_dump($data);
        die();

        $this->template->show('login');
    }
}

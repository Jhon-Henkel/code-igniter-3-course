<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model('CoursesModel');
        $this->load->model('TeamModel');
        $data = [
            "scripts" => [
                "owl.carousel.min.js",
                "theme-scripts.js"
            ],
            "courses" => $this->CoursesModel->showCourses(),
            "team" => $this->TeamModel->showTeam()
        ];
        $this->template->show('home', $data);
    }
}

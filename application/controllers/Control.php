<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
    public function index()
    {
        $this->load->view('control/template/header');
        $this->load->view('control/statistics');
        $this->load->view('control/template/footer');
    }
}

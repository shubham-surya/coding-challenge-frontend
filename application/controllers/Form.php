<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

    public function users(){

        $this->load->view('template/header');
        $this->load->view('users');
        $this->load->view('template/footer');

    }
}
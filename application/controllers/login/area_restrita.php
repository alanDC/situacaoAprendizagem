<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_restrita extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('membership_model', 'usuario');
        $this->usuario->logged();
    }
    
    public function index() {
        $this->load->view('home_header');          
        $this->load->view('login/area_restrita_view');
        $this->load->view('home_sidebar');
    }
}
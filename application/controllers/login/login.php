<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');


        // MODELO MEMBERSHIP
        $this->load->model('membership_model', 'usuario');
        $query = $this->usuario->validate();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home_header');
            $this->load->view('login/login_view');  
            $this->load->view('home_sidebar');
            
        } else {

            if ($query) { // VERIFICA LOGIN E SENHA
                $data = array(
                    'nome' => $this->input->post('nome'),
                    'logged' => true
                );
                $this->session->set_userdata($data);
                redirect('login/area_restrita');
            } else {
               
                redirect('http://127.0.0.1/situacaoAprendizagem/index.php/login');
            }
        }
    }
    
      function sair(){
        $this->session->unset_userdata('logado');
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}




<?php
class Membership_model extends CI_Model {

    # VALIDA USUÁRIO
    function validate() {
        $this->db->where('nome', $this->input->post('nome')); 
        //$this->db->where('password', md5($this->input->post('password')));
        $this->db->where('senha', $this->input->post('senha'));
       

        $query = $this->db->get('usuario'); 
        
        if ($query->num_rows == 1) { 
            return true; // RETORNA VERDADEIRO
        }
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function logged() {
        $logged = $this->session->userdata('logged');

        if (!isset($logged) || $logged != true) {
            echo 'Voce nao tem permissao para entrar nessa pagina. <a href="http://127.0.0.1/situacaoAprendizagem/login">Efetuar Login</a>';
            die();
        }
    }
}



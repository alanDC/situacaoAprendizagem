<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artigo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserir($data) {
        return $this->db->insert('artigo', $data);
    }

    function listar() {
        $query = $this->db->get('artigo');
        return $query->result();
    }

    function editar($id) {
        $this->db->where('idartigo', $id);
        $query = $this->db->get('artigo');
        
        return $query->result();
    }

    function atualizar($data) {
        $this->db->where('artigo', $data['artigo']);
        $this->db->set($data);
       echo print_r($data);
        die();
        return $this->db->update('artigo');
       
    }

    function deletar($id) {
        $this->db->where('idartigo', $id);
        return $this->db->delete('artigo');
    }
    
    function logged() {
        $logged = $this->session->userdata('logged');

        if (!isset($logged) || $logged != true) {
            echo 'Voce nao tem permissao para entrar nessa pagina. <a href="http://127.0.0.1/situacaoAprendizagem/login">Efetuar Login</a>';
            die();
        }
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artigos_model extends CI_Model {

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
        $this->db->where('idartigo', $data['idartigo']);
        $this->db->set($data);
        return $this->db->update('artigo');
    }

    function deletar($id) {
        $this->db->where('idartigo', $id);
        return $this->db->delete('artigo');
    }

}



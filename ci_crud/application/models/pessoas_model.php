<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pessoas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserir($data) {
        return $this->db->insert('pessoas', $data);
        
    }

    function listar() {
        $query = $this->db->get('pessoas');
        return $query->result();
    }

    function editar($id) {
        $this->db->where('idusuario', $id);
        $query = $this->db->get('pessoas');
        return $query->result();
    }

    function atualizar($data) {
        $this->db->where('idusuario', $data['idusuario']);
        $this->db->set($data);
        return $this->db->update('pessoas');
    }

    function deletar($id) {
        $this->db->where('idusuario', $id);
        return $this->db->delete('pessoas');
    }

}

/* 
 * Código retirado de : "http://phpdojo.com.br/php/crud-completo-com-codeigniter-parte-iv/"
 */


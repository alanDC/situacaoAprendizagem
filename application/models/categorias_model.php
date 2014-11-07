<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserir($data) {
        return $this->db->insert('categoria', $data);
    }

    function listar() {
        $query = $this->db->get('categoria');
        return $query->result();
    }

    function editar($id) {
        $this->db->where('idcategoria', $id);
        $query = $this->db->get('categoria');
        return $query->result();
    }

    function atualizar($data) {
        $this->db->where('idcategoria', $data['idcategoria']);
        $this->db->set($data);
        return $this->db->update('categoria');
    }

    function deletar($id) {
        $this->db->where('idcategoria', $id);
        return $this->db->delete('categoria');
    }

}

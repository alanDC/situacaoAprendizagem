<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Carrega o modelo */
        $this->load->model('categorias_model');
    }

    function index() {
        $data['titulo'] = "CRUD com CodeIgniter | Cadastro de Categorias";
        $data['categorias'] = $this->categorias_model->listar();
        $this->load->view('categorias_view.php', $data);
    }

    function inserir() {

        /* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
        $this->load->library('form_validation');

        /* Define as tags onde a mensagem de erro será exibida na página */
        $this->form_validation->set_error_delimiters('<span>', '</span>');

        /* Define as regras para validação */
        $this->form_validation->set_rules('categoria', 'Categoria', 'required|max_length[15]');
        $this->form_validation->set_rules('descricao', 'Descricao', 'required|max_length[100]');
        

        /* Executa a validação e caso houver erro... */
        if ($this->form_validation->run() === FALSE) {
            /* Chama a função index do controlador */
            $this->index();
            /* Senão, caso sucesso na validação... */
        } else {
            /* Recebe os dados do formulário (visão) */
            $data['categoria'] = $this->input->post('categoria');
            $data['descricao'] = $this->input->post('descricao');
            

            /* Carrega o modelo */
            $this->load->model('categorias_model');

            /* Chama a função inserir do modelo */
            if ($this->categorias_model->inserir($data)) {
                redirect('categorias');
            } else {
                log_message('error', 'Erro ao inserir a categoria.');
            }
        }
    }

    function editar($id) {

        /* Aqui vamos definir o título da página de edição */
        $data['titulo'] = "CRUD com CodeIgniter | Editar Categoria";

        /* Carrega o modelo */
        $this->load->model('categorias_model');

        /* Busca os dados da pessoa que será editada (id) */
        $data['dados_categoria'] = $this->categorias_model->editar($id);
        
        /* Carrega a página de edição com os dados da pessoa */
        $this->load->view('categorias_edit', $data);
    }

    function atualizar() {

        /* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
        $this->load->library('form_validation');

        /* Define as tags onde a mensagem de erro será exibida na página */
        $this->form_validation->set_error_delimiters('<span>', '</span>');

        /* Aqui estou definindo as regras de validação do formulário, assim como 
          na função inserir do controlador, porém estou mudando a forma de escrita */
        $validations = array(
            array(
                'field' => 'categoria',
                'label' => 'Categoria',
                'rules' => 'required|max_length[15]'
            ),
            array(
                'field' => 'descricao',
                'label' => 'Descrição',
                'rules' => 'required|max_length[100]'
            ));
        $this->form_validation->set_rules($validations);

        /* Executa a validação... */
        if ($this->form_validation->run() === FALSE) {
            /* Caso houver erro chama função editar do controlador novamente */
            $this->editar($this->input->post('idcategoria'));
        } else {
            /* Senão obtém os dados do formulário */
            $data['idcategoria'] = $this->input->post('idcategoria');
            $data['categoria'] = ucwords($this->input->post('categoria'));
            $data['descricao'] = strtolower($this->input->post('descricao'));
            

            /* Carrega o modelo */
            $this->load->model('categorias_model');

            /* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
            if ($this->categorias_model->atualizar($data)) {
                /* Caso sucesso ao atualizar, recarrega a página principal */
                redirect('categorias');
            } else {
                /* Senão exibe a mensagem de erro */
                log_message('error', 'Erro ao atualizar a categoria.');
            }
        }
    }

    function deletar($id) {

        /* Carrega o modelo */
        $this->load->model('categorias_model');

        /* Executa a função deletar do modelo passando como parâmetro o id da pessoa */
        if ($this->categorias_model->deletar($id)) {
            /* Caso sucesso ao atualizar, recarrega a página principal */
            redirect('categorias');
        } else {
            /* Senão exibe a mensagem de erro */
            log_message('error', 'Erro ao deletar a categoria.');
        }
    }

}

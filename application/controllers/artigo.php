<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artigos extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Carrega o modelo */
        $this->load->model('artigos_model');
    }

    function index() {
    //      $data['titulo'] = "CRUD com CodeIgniter | Cadastro de Pessoas";
            $data['artigos'] = $this->artigos_model->listar();
    //      $this->load->view('pessoas_view.php', $data);

        $this->load->view('home_header');
        $this->load->view('artigos_view', $data);
        $this->load->view('home_sidebar');
    }

    function inserir() {

        /* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
        $this->load->library('form_validation');
     ;

        /* Define as tags onde a mensagem de erro será exibida na página */
        $this->form_validation->set_error_delimiters('<span>', '</span>');

        /* Define as regras para validação */
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[40]');
        $this->form_validation->set_rules('conteudo', 'Conteudo', '');
        $this->form_validation->set_rules('data', 'Data', '');
        
        


        /* Executa a validação e caso houver erro... */
        if ($this->form_validation->run() === FALSE) {
            /* Chama a função index do controlador */
            $this->index();
            /* Senão, caso sucesso na validação... */
        } else {

            /* Recebe os dados do formulário (visão) */
            $data['titulo'] = $this->input->post('titulo');
            $data['conteudo'] = $this->input->post('conteudo');
            $data['data'] = $this->input->post('data');
          

            /* Chama a função inserir do modelo */
            if ($this->artigos_model->inserir($data)) {
                redirect('artigo');
            } else {
                log_message('error', 'Erro ao inserir a pessoa.');
            }
        }
    }

    function editar($id) {

        /* Aqui vamos definir o título da página de edição */
        $data['titulo'] = "Adicionar um artigo";

        /* Carrega o modelo */
        $this->load->model('artigos_model');

        /* Busca os dados da pessoa que será editada (id) */
        $data['dados_artigo'] = $this->artigos_model->editar($id);

        /* Carrega a página de edição com os dados da pessoa */
        $this->load->view('home_header');
        $this->load->view('artigo_view_edit', $data);
        $this->load->view('home_sidebar');
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
                'field' => 'titulo',
                'label' => 'Titulo',
                'rules' => 'trim|required|max_length[40]'
            ),
            array(
                'field' => 'conteudo',
                'label' => 'Conteudo',
                'rules' => 'trim|required|valid_email|max_length[100]'
            ),
            array(
                'field' => 'data',
                'label' => 'Data',
                'rules' => ''
            ),
           
        );
        $this->form_validation->set_rules($validations);

        /* Executa a validação... */
        if ($this->form_validation->run() === FALSE) {
            /* Caso houver erro chama função editar do controlador novamente */
            $this->editar($this->input->post('idartigo'));
        } else {
            /* Senão obtém os dados do formulário */
            $data['idartigo'] = $this->input->post('idartigo');
            $data['titulo'] = ucwords($this->input->post('titulo'));
            $data['conteudo'] = strtolower($this->input->post('conteudo'));
            $data['data'] = strtolower($this->input->post('data'));
           
            /* Carrega o modelo */
            $this->load->model('artigos_model');

            /* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
            if ($this->artigos_model->atualizar($data)) {
                /* Caso sucesso ao atualizar, recarrega a página principal */
                redirect('artigo');
            } else {
                /* Senão exibe a mensagem de erro */
                log_message('error', 'Erro ao atualizar a pessoa.');
            }
        }
    }

    function deletar($id) {

        /* Carrega o modelo */
        $this->load->model('artigos_model');

        /* Executa a função deletar do modelo passando como parâmetro o id da pessoa */
        if ($this->artigos_model->deletar($id)) {
            /* Caso sucesso ao atualizar, recarrega a página principal */
            redirect('artigos');
        } else {
            /* Senão exibe a mensagem de erro */
            log_message('error', 'Erro ao deletar o artigo.');
        }
    }

}




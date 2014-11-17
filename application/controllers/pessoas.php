<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pessoas extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* Carrega o modelo */
        $this->load->model('pessoas_model');
    }

    function index() {
    //      $data['titulo'] = "CRUD com CodeIgniter | Cadastro de Pessoas";
            $data['pessoas'] = $this->pessoas_model->listar();
    //      $this->load->view('pessoas_view.php', $data);

        $this->load->view('home_header');
        $this->load->view('home_content_usuario', $data);
        $this->load->view('home_sidebar');
    }

    function inserir() {

        /* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
        $this->load->library('form_validation');
        $this->load->library('image_lib');

        /* Define as tags onde a mensagem de erro será exibida na página */
        $this->form_validation->set_error_delimiters('<span>', '</span>');

        /* Define as regras para validação */
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[40]');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('idade', 'Idade', '');
        $this->form_validation->set_rules('foto', 'Foto', '');
        $this->form_validation->set_rules('senha', 'Senha', '');


        /* Executa a validação e caso houver erro... */
        if ($this->form_validation->run() === FALSE) {
            /* Chama a função index do controlador */
            $this->index();
            /* Senão, caso sucesso na validação... */
        } else {

            /* Recebe os dados do formulário (visão) */
            $data['nome'] = $this->input->post('nome');
            $data['email'] = $this->input->post('email');
            $data['idade'] = $this->input->post('idade');
            $data['foto'] = $this->input->post('foto');
            $data['senha'] = $this->input->post('senha');

            /* Chama a função inserir do modelo */
            if ($this->pessoas_model->inserir($data)) {
                redirect('pessoas');
            } else {
                log_message('error', 'Erro ao inserir a pessoa.');
            }
        }
    }

    function editar($id) {

        /* Aqui vamos definir o título da página de edição */
        $data['titulo'] = "CRUD com CodeIgniter | Editar Pessoa";

        /* Carrega o modelo */
        $this->load->model('pessoas_model');

        /* Busca os dados da pessoa que será editada (id) */
        $data['dados_pessoa'] = $this->pessoas_model->editar($id);

        /* Carrega a página de edição com os dados da pessoa */
        $this->load->view('home_header');
        $this->load->view('home_content_usuario_edit', $data);
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
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|max_length[40]'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email|max_length[100]'
            ),
            array(
                'field' => 'idade',
                'label' => 'Idade',
                'rules' => ''
            ),
            array(
                'field' => 'foto',
                'label' => 'Foto',
                'rules' => ''
            ),
            array(
                'field' => 'senha',
                'label' => 'Senha',
                'rules' => ''
            )
        );
        $this->form_validation->set_rules($validations);

        /* Executa a validação... */
        if ($this->form_validation->run() === FALSE) {
            /* Caso houver erro chama função editar do controlador novamente */
            $this->editar($this->input->post('idusuario'));
        } else {
            /* Senão obtém os dados do formulário */
            $data['idusuario'] = $this->input->post('idusuario');
            $data['nome'] = ucwords($this->input->post('nome'));
            $data['email'] = strtolower($this->input->post('email'));
            $data['idade'] = strtolower($this->input->post('idade'));
            $data['foto'] = strtolower($this->input->post('foto'));
            $data['senha'] = strtolower($this->input->post('senha'));
            /* Carrega o modelo */
            $this->load->model('pessoas_model');

            /* Executa a função atualizar do modelo passando como parâmetro os dados obtidos do formulário */
            if ($this->pessoas_model->atualizar($data)) {
                /* Caso sucesso ao atualizar, recarrega a página principal */
                redirect('pessoas');
            } else {
                /* Senão exibe a mensagem de erro */
                log_message('error', 'Erro ao atualizar a pessoa.');
            }
        }
    }

    function deletar($id) {

        /* Carrega o modelo */
        $this->load->model('pessoas_model');

        /* Executa a função deletar do modelo passando como parâmetro o id da pessoa */
        if ($this->pessoas_model->deletar($id)) {
            /* Caso sucesso ao atualizar, recarrega a página principal */
            redirect('pessoas');
        } else {
            /* Senão exibe a mensagem de erro */
            log_message('error', 'Erro ao deletar a pessoa.');
        }
    }

}

//Código retirado de: "http://phpdojo.com.br/php/crud-completo-com-codeigniter-parte-ii/"
/*
 * – O nome da classe deve ser igual ao nome do arquivo e iniciar com letra maiúscula.
 * – A função index será executada por padrão caso não tenha sido informado nenhuma outra função na URL da aplicação (veremos isso em breve).
 * – O array $data armazena o título, observe o índice com o mesmo nome, e será recuperado posteriormente na visão.
 * – No método $this->load->view(‘pessoas_view.php’, $data), passamos dois parâmetros, a visão que iremos carregar e o array que contém as informações.
 */

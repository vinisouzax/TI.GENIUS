<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de usuários
class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();

        //Model das funcionalidades
        $ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE) {
			$dados['titulo']= ' Login do Sistema';
			$dados['h2'] = ' Login do Sistema';
			set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
			redirect('Autenticacao');
		}
		$this->load->helper('funcoes');
		$this->load->model('Variaveis_model', 'vm');
		$this->load->model('Regras_model', 'rm');
		$this->load->model('Categorias_model', 'cm');
		$this->load->model('Comentarios_model', 'com');

	}

	public function index(){
		$ci = & get_instance();
		$variaveis = $this->vm->GetAllVariaveis();
		$valores = $this->vm->GetAllValores();
		$dados=array(
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
			'variaveis' => $variaveis,
			'valores' => $valores
		);
		$dados['variaveis'] = $this->vm->GetAllVariaveis();
		$dados['valores'] = $this->vm->GetAllValores();	
		$dados['regras'] = $this->rm->GetAllRegras();
		$dados['regrasxvariaveis'] = $this->rm->GetAllRegrasXVariaveis();
		$dados['categorias'] = $this->cm->GetAllCategorias();		
		$this->load->view('home',$dados);
	}

}

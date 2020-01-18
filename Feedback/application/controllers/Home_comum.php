<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de usuários
class Home_comum extends CI_Controller {

	public function __construct(){

		parent::__construct();

        //Model das funcionalidades
		$this->load->helper('funcoes');
		$this->load->model('Variaveis_model', 'vm');
		$this->load->model('Regras_model', 'rm');
		$this->load->model('Categorias_model', 'cm');
		$this->load->model('Comentarios_model', 'com');

	}

	public function index(){
		$variaveis = $this->vm->GetAllVariaveis();
		$valores = $this->vm->GetAllValores();
		$dados=array(
			'variaveis' => $variaveis,
			'valores' => $valores
		);
		$dados['nivelAcesso'] = 'Comum';
		$dados['variaveis'] = $this->vm->GetAllVariaveis();
		$dados['valores'] = $this->vm->GetAllValores();	
		$dados['regras'] = $this->rm->GetAllRegras();
		$dados['regrasxvariaveis'] = $this->rm->GetAllRegrasXVariaveis();
		$dados['categorias'] = $this->cm->GetAllCategorias();		
		$this->load->view('homeComum',$dados);		
	}

}

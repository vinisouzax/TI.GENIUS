<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de categorias
class Categorias extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE || $ci->session->userdata('nivelAcesso') != "Administrador") {
			$dados['titulo']= ' Login do Sistema';
			$dados['h2'] = ' Login do Sistema';
			set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
			redirect('Autenticacao');
		}
        //Model das funcionalidades
		$this->load->model('Categorias_model','cm');
		$this->load->model('Regras_model','rm');
		$this->load->helper('funcoes');
	}
	//carrega tela principal de manutenção de categorias
	public function index(){
		$ci = & get_instance();
		$dados=array(
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);
		$dados['categorias'] = $this->cm->GetAllCategorias();
		$this->load->view('categorias_view',$dados);
	}

	//CARREGA FORMULARIO DE CADASTRO DE categoria
	public function mostra_cadastro_categoria() {
		$ci = & get_instance();
		$dados = array(
			'nmCategoria' => '',
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);
		$this->load->view('cadastro_categorias',$dados);
	}

	//Adicionar nova categoria

	public function AddCategoria(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');

		$dados = array(
			'nmVariavel' => '',
		);

		$nmCategoria = $this->input->post('Nome');

		$categoriaExiste = $this->cm->VerifyCategoria($nmCategoria, 0);

		if ($this->form_validation->run() == FALSE || $categoriaExiste == true) {

			if($categoriaExiste == true){
				set_msg('<center><b>Categoria já existe!!!</b></center>');
			}

			$dados= array(
				'nmCategoria' => $this->input->post('Nome'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				);

			$this->load->view('cadastro_categorias', $dados);
		} else {

			$dados = array(
				'nmCategoria' => $nmCategoria,
				);

			$this->cm->AddCategoria($dados);
			set_msg('<center><b>Categoria cadastrada com sucesso!!!</b></center>');

			redirect(base_url('Categorias/index'));

		}
	}
	//atualiza categoria
	public function UpdateCategoria(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');

		$nmCategoria = $this->input->post('Nome');
		
		$idCategoria = $this->input->post('Id');

		$categoriaExiste = $this->cm->VerifyCategoria($nmCategoria, $idCategoria);

		if ($this->form_validation->run() == FALSE || $categoriaExiste == true) {

			if($categoriaExiste == true){
				set_msg('<center><b>Categoria já existe!!!</b></center>');
			}

			$dados= array(
				'nmCategoria' => $this->input->post('Nome'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				);

			$this->load->view('cadastro_categorias', $dados);
		} else {
			
			$dados = array(
				'nmCategoria' => $nmCategoria,
			);

			$this->cm->UpdateCategoria($idCategoria, $dados);
			set_msg('<center><b>Categoria atualizada com sucesso!!!</b></center>');

			redirect(base_url('Categorias/index'));

		}
	}
//chama view de edição de categoria
	public function EditCategoria($idCategoria){
		$ci = & get_instance();
		$dados=array(
		  	'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
	    );

        $dados['categoria'] = $this->cm->GetCategoriaById($idCategoria);

		$this->load->view('edita_categoria_view',$dados);
	}

    //DELETA categoria e as regras ligadas a esta categoria
	public function DeleteCategoria($idCategoria){

		$this->cm->DeleteCategoria($idCategoria);
		$regras = $this->rm->GetRegrasByIdCategoria($idCategoria);
		foreach($regras as $regra){
			$this->rm->DeleteRegra($regra->idRegra);
			$this->rm->DeleteRegrasXVariaveis($regra->idRegra);
		}
		set_msg('<b>Categoria deletada com Sucesso! </b>');

		redirect(base_url('Categorias/index'));
	}

}
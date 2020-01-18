<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de usuários
class Variaveis extends CI_Controller {

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
		$this->load->model('Variaveis_model','vm');
		$this->load->model('Regras_model','rm');
		$this->load->helper('funcoes');
	}
	//carrega tela principal de manutenção de usuarios
	public function index(){
		$ci = & get_instance();
		$dados=array(
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);
		$dados['variaveis'] = $this->vm->GetAllVariaveis();
		$dados['valores'] = $this->vm->GetAllValores();
		$this->load->view('variaveis_view',$dados);
	}

	//CARREGA FORMULARIO DE CADASTRO DE VARIAVEIS
	public function mostra_cadastro_variavel() {
		$ci = & get_instance();
		$dados = array(
			'nmVariavel' => '',
			'pergunta' => '',
			'qtd' => '',
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);
		$this->load->view('cadastro_variaveis',$dados);
	}

	//Adicionar nova variavel e seus valores

	public function AddVariavel(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('Pergunta', 'Pergunta', 'trim');
		$this->form_validation->set_rules('qtd', 'qtd', 'trim|required');
		$qtd = $this->input->post('qtd');

		$dados = array(
			'nmVariavel' => '',
			'Pergunta' => '',
			'qtd' => '',
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);

		$nmVariavel = $this->input->post('Nome');

		$variavelExiste = $this->vm->VerifyVariavel($nmVariavel, 0);

		if ($this->form_validation->run() == FALSE || $variavelExiste == true || $qtd == '') {

			if($variavelExiste == true && $qtd == 0){
				set_msg('<center><b>Variável já existe!!!</b><br><br><b>Não foi colocado nenhum valor para a variável!!!</b></center>');
			}

			else if($variavelExiste == true){
				set_msg('<center><b>Variável já existe!!!</b></center>');
			}

			else if($qtd == 0){
				set_msg('<center><b>Não foi colocado nenhum valor para a variável!!!</b></center>');
			}

			$dados= array(
				'nmVariavel' => $this->input->post('Nome'),
				'pergunta' => $this->input->post('Pergunta'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				'qtd' => $qtd
				);

			$this->load->view('cadastro_variaveis', $dados);
		} else {
			$pergunta = $this->input->post('Pergunta');
			if($pergunta == ""){
				$pergunta = "Qual o valor de ".$nmVariavel."?";
			}
			$dados = array(
				'nmVariavel' => $nmVariavel,
				'pergunta' => $pergunta,
				);

			$this->vm->AddVariavel($dados);
			set_msg('<center><b>Variável cadastrada com sucesso!!!</b></center>');
			$variavel = $this->vm->GetIdVariavelByName($nmVariavel);
			//pega cada valor dos input com id = Valor e adiciona no banco
			for($i = 0; $i < $qtd; $i++){

				$valor = "";
				$valor = "Valor".$i;

				$dados = array(
					'nmValor' => $this->input->post($valor),
					'idVariavel' => $variavel->idVariavel
					);

				$this->vm->AddValor($dados);
			}

			redirect(base_url('Variaveis/index'));

		}
	}
	//atualiza variavel e seus valores
	public function UpdateVariavel(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('Pergunta', 'Pergunta', 'trim');
		$this->form_validation->set_rules('qtd', 'qtd', 'trim|required');
		$qtd = $this->input->post('qtd');

		$nmVariavel = $this->input->post('Nome');
		
		$idVariavel = $this->input->post('Id');

		$variavelExiste = $this->vm->VerifyVariavel($nmVariavel, $idVariavel);

		if ($this->form_validation->run() == FALSE || $variavelExiste == true || $qtd == '') {

			if($variavelExiste == true && $qtd == 0){
				set_msg('<center><b>Variável já existe!!!</b><br><br><b>Não foi colocado nenhum valor para a variável!!!</b></center>');
			}

			else if($variavelExiste == true){
				set_msg('<center><b>Variável já existe!!!</b></center>');
			}

			else if($qtd == 0){
				set_msg('<center><b>Não foi colocado nenhum valor para a variável!!!</b></center>');
			}

			$dados= array(
				'nmVariavel' => $this->input->post('Nome'),
				'pergunta' => $this->input->post('Pergunta'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				'qtd' => $qtd
				);

			$this->load->view('edita_variavel_view', $dados);
		} else {
			$pergunta = $this->input->post('Pergunta');
			if($pergunta == ""){
				$pergunta = "Qual o valor de ".$nmVariavel."?";
			}			
			$dados = array(
				'nmVariavel' => $nmVariavel,
				'pergunta' => $pergunta,
			);

			$this->vm->UpdateVariavel($idVariavel, $dados);
			set_msg('<center><b>Variável atualizada com sucesso!!!</b></center>');
			//atualiza cada valor da tabela ou adiciona caso nao haja id
			for($i = 0; $i < $qtd; $i++){

				$nmvalor = "";
				$nmvalor = "nmValor".$i;
				$idvalor = "";
				$idvalor = "idValor".$i;
				$id = $this->input->post($idvalor);

				if($id != 0){
					$dados = array(
						'nmValor' => $this->input->post($nmvalor)
					);
					$this->vm->UpdateValor($id, $dados);
				}else{
					$dados = array(
						'nmValor' => $this->input->post($nmvalor),
						'idVariavel' => $idVariavel
					);
					$this->vm->AddValor($dados);
				}
			}

			redirect(base_url('Variaveis/index'));

		}
	}
//chama view de editar variavel
	public function EditVariavel($idVariavel){
		$ci = & get_instance();
		$dados=array(
		  	'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
	    );

        $dados['variavel'] = $this->vm->GetVariavelById($idVariavel);
        $dados['valores'] = $this->vm->GetValoresByIdVariavel($idVariavel);

		$this->load->view('edita_variavel_view',$dados);
	}

    //DELETA VARIAVEL e as regras ligadas a mesma
	public function DeleteVariavel($idVariavel){

		$this->vm->DeleteVariavel($idVariavel);
		$this->vm->DeleteValores($idVariavel);
		$regras = $this->rm->GetRegrasByIdVariavel($idVariavel);
		foreach($regras as $regra){
			$this->rm->DeleteRegra($regra->idRegra);
			$this->rm->DeleteRegrasXVariaveis($regra->idRegra);
		}
		set_msg('<b>Variável deletada com Sucesso! </b>');

		redirect(base_url('Variaveis/index'));
	}

    //DELETA VALOR
	public function DeleteValor($idValor){

		$this->vm->DeleteValor($idValor);
		set_msg('<b>Valor deletado com Sucesso! </b>');

		redirect(base_url('Variaveis/index'));
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de usuários
class Regras extends CI_Controller {

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
        $this->load->model('Regras_model','rm');
		$this->load->model('Variaveis_model','vm');
		$this->load->model('Categorias_model','cm');
		$this->load->helper('funcoes');
	}
	//carrega tela principal de manutenção de regras
	public function index(){
		$ci = & get_instance();
		$dados=array(
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);
		$dados['regras'] = $this->rm->GetAllRegras();
		$dados['categorias'] = $this->cm->GetAllCategorias();
		$this->load->view('regras_view',$dados);
	}

	//CARREGA FORMULARIO DE CADASTRO DE REGRAS
	public function mostra_cadastro_regras() {
		$ci = & get_instance();
		$dados = array(
			'nmRegra' => '',
			'solucao' => '',
			'qtd' => '',
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
            );
        $dados['variaveis'] = $this->vm->GetAllVariaveis();
		$dados['valores'] = $this->vm->GetAllValores();
		$dados['categorias'] = $this->cm->GetAllCategorias();
		$this->load->view('cadastro_regras',$dados);
	}

	//Adicionar nova REGRA e liga as variaveis a mesma

	public function AddRegra(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('qtd', 'qtd', 'trim|required');
		$this->form_validation->set_rules('Categoria', 'Categoria', 'trim|required');
		$qtd = $this->input->post('qtd');

		$this->load->library('upload');
        // definimos o path onde o arquivo será gravado
		$path = "./tutoriais/";

        // verificamos se o diretório existe
        // se não existe criamos com permissão de leitura e escrita
        if ( ! is_dir($path)) {
        	mkdir($path, 0777, $recursive = true);
    	}

        // definimos as configurações para o upload
        // determinamos o path para gravar o arquivo
        $configUpload['upload_path']   = $path;
        // definimos - através da extensão - 
        // os tipos de arquivos suportados
        $configUpload['allowed_types'] = 'pdf';

        $this->upload->initialize($configUpload);
        $conteudo = "";	

		$dados = array(
			'nmRegra' => '',
			'qtd' => '',
			'idCategoria'=> $this->input->post('Categoria'), 
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);

		$nmRegra = $this->input->post('Nome');

		$regraExiste = $this->rm->VerifyRegra($nmRegra, 0);

		if ($this->form_validation->run() == FALSE || $regraExiste == true || $qtd == '' || !$this->upload->do_upload('solucao')) {

			if($regraExiste == true && $qtd == 0){
				set_msg('<center><b>Regra já existe!!!</b><br><br><b>Não foi colocada nenhuma variável para a regra!!!</b></center>');
			}

			else if($regraExiste == true){
				set_msg('<center><b>Regra já existe!!!</b></center>');
			}

			else if($qtd == 0){
				set_msg('<center><b>Não foi colocada nenhuma variavel para a regra!!!</b></center>');
			}
			else{
				set_msg('<center><b>Erro com arquivo!!!</b></center>');
			}

			$dados= array(
				'nmRegra' => $this->input->post('Nome'),
				'idCategoria'=> $this->input->post('Categoria'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				'qtd' => $qtd
				);

			$dados['variaveis'] = $this->vm->GetAllVariaveis();
			$dados['valores'] = $this->vm->GetAllValores();
			$dados['categorias'] = $this->cm->GetAllCategorias();
			$this->load->view('cadastro_regras', $dados);
		} else {
			//coloca o pdf da solucao
			$conteudo = $this->upload->data();
			$solucao = base_url() . "tutoriais/" . $conteudo['file_name'];				

			$dados = array(
				'nmRegra' => $nmRegra,
				'idCategoria'=> $this->input->post('Categoria'),
				'solucao' => $solucao
				);

			$this->rm->AddRegra($dados);
			set_msg('<center><b>Regra cadastrada com sucesso!!!</b></center>');
			$regra = $this->rm->GetIdRegraByName($nmRegra);
			//interliga as variaveis e valores a regra, por meio da tabela RegraXVariavel
			for($i = 0; $i < $qtd; $i++){

                $variavel = "";
                $variavel = "Variavel".$i;
				$valor = "";
				$valor = "Valor".$i;

				$dados = array(
					'idVariavel' => $this->input->post($variavel),
                    'idRegra' => $regra->idRegra,
                    'idValor' => $this->input->post($valor)
					);

				$this->rm->AddRegraXVariavel($dados);
			}

			redirect(base_url('Regras/index'));

		}
	}
	//atualiza regra e as variaveis que compoem a mesma
	public function UpdateRegra(){
		$ci = & get_instance();	
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('qtd', 'qtd', 'trim|required');
		$this->form_validation->set_rules('Categoria', 'Categoria', 'trim|required');
		$qtd = $this->input->post('qtd');

		$this->load->library('upload');
        // definimos o path onde o arquivo será gravado
		$path = "./tutoriais/";

        // verificamos se o diretório existe
        // se não existe criamos com permissão de leitura e escrita
        if ( ! is_dir($path)) {
        	mkdir($path, 0777, $recursive = true);
    	}

        // definimos as configurações para o upload
        // determinamos o path para gravar o arquivo
        $configUpload['upload_path']   = $path;
        // definimos - através da extensão - 
        // os tipos de arquivos suportados
        $configUpload['allowed_types'] = 'pdf';

        $this->upload->initialize($configUpload);

        $conteudo = "";	

		$dados = array(
			'nmRegra' => '',
			'qtd' => '',
			'idCategoria'=> $this->input->post('Categoria'), 
			'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
			);

		$nmRegra = $this->input->post('Nome');

		$idRegra = $this->input->post('Id');

		$regraExiste = $this->rm->VerifyRegra($nmRegra, $idRegra);

		if ($this->form_validation->run() == FALSE || $regraExiste == true || $qtd == '') {

			if($regraExiste == true && $qtd == 0){
				set_msg('<center><b>Regra já existe!!!</b><br><br><b>Não foi colocada nenhuma variável para a regra!!!</b></center>');
			}

			else if($regraExiste == true){
				set_msg('<center><b>Regra já existe!!!</b></center>');
			}

			else if($qtd == 0){
				set_msg('<center><b>Não foi colocada nenhuma variavel para a regra!!!</b></center>');
			}

			$dados= array(
				'nmRegra' => $this->input->post('Nome'),
				'idCategoria'=> $this->input->post('Categoria'),
				'nmLogin' =>$ci->session->userdata('nmLogin'),
				'nivelAcesso' =>$ci->session->userdata('nivelAcesso'),
				'qtd' => $qtd
				);

			$dados['variaveis'] = $this->vm->GetAllVariaveis();
			$dados['valores'] = $this->vm->GetAllValores();
			$dados['categorias'] = $this->cm->GetAllCategorias();
			$dados['regrasxvariaveis'] = $this->rm->GetAllRegrasXVariaveis();
			$this->load->view('edita_regra_view', $dados);

		} else {
			//se colocar algum pdf usa essa funcao para editar, senão deixa o que estava
			if($this->upload->do_upload('solucao')){
				$conteudo = $this->upload->data();
				$solucao = base_url() . "tutoriais/" . $conteudo['file_name'];	
				$dados = array(
					'nmRegra' => $nmRegra,
					'idCategoria'=> $this->input->post('Categoria'),
					'solucao' => $solucao
					);

				$this->rm->UpdateRegra($idRegra, $dados);
				set_msg('<center><b>Regra atualizada com sucesso!!!</b></center>');
				//interliga as variaveis e valores a regra, por meio da tabela RegraXVariavel
				for($i = 0; $i < $qtd; $i++){

					$variavel = "";
					$variavel = "Variavel".$i;
					$valor = "";
					$valor = "Valor".$i;
					$regraxvariavel = "";
					$regraxvariavel = "RegraXVariavel".$i;
					$idRegraXVariavel = $this->input->post($regraxvariavel);

					if($idRegraXVariavel != 0){
						$dados = array(
							'idVariavel' => $this->input->post($variavel),
							'idValor' => $this->input->post($valor),
							);

						$this->rm->UpdateRegraXVariavel($idRegraXVariavel, $dados);
					}else{
						$dados = array(
							'idVariavel' => $this->input->post($variavel),
							'idRegra' => $idRegra,
							'idValor' => $this->input->post($valor)
							);
		
						$this->rm->AddRegraXVariavel($dados);
					}
				}

				redirect(base_url('Regras/index'));		
			}else{
				
				$dados = array(
					'nmRegra' => $nmRegra,
					'idCategoria'=> $this->input->post('Categoria')
					);

				$this->rm->UpdateRegra($idRegra, $dados);
				set_msg('<center><b>Regra atualizada com sucesso!!!</b></center>');

				for($i = 0; $i < $qtd; $i++){

					$variavel = "";
					$variavel = "Variavel".$i;
					$valor = "";
					$valor = "Valor".$i;
					$regraxvariavel = "";
					$regraxvariavel = "RegraXVariavel".$i;
					$idRegraXVariavel = $this->input->post($regraxvariavel);

					if($idRegraXVariavel != 0){
						$dados = array(
							'idVariavel' => $this->input->post($variavel),
							'idValor' => $this->input->post($valor),
							);

						$this->rm->UpdateRegraXVariavel($idRegraXVariavel, $dados);
					}else{
						$dados = array(
							'idVariavel' => $this->input->post($variavel),
							'idRegra' => $idRegra,
							'idValor' => $this->input->post($valor)
							);
		
						$this->rm->AddRegraXVariavel($dados);
					}
				}

				redirect(base_url('Regras/index'));
			}

		}
	}
//chama view de editar regra
	public function EditRegra($idRegra){
		$ci = & get_instance();
		$dados=array(
		  	'nmLogin' =>$ci->session->userdata('nmLogin'),
			'nivelAcesso' =>$ci->session->userdata('nivelAcesso')
	    );

		$dados['regra'] = $this->rm->GetRegraById($idRegra);
		$dados['variaveis'] = $this->vm->GetAllVariaveis();
		$dados['valores'] = $this->vm->GetAllValores();
		$dados['categorias'] = $this->cm->GetAllCategorias();
		$dados['regrasxvariaveis'] = $this->rm->GetAllRegrasXVariaveis();

		$this->load->view('edita_regra_view',$dados);
	}

    //DELETA Regra
	public function DeleteRegra($idRegra){

		$this->rm->DeleteRegra($idRegra);
		$this->rm->DeleteRegrasXVariaveis($idRegra);
		set_msg('<b>Regra deletada com Sucesso! </b>');

		redirect(base_url('Regras/index'));
	}

    //DELETA Regra
	public function DeleteRegraXVariavel($idRegraXVariavel){

		$this->rm->DeleteRegraXVariavel($idRegraXVariavel);
		set_msg('<b>Condição deletada com Sucesso! </b>');

		redirect(base_url('Regras/index'));
	}
}
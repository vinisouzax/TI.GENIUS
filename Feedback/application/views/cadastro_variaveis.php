
<html>
<!-- TELA DE CADASTRO DE USUARIO-->

<head>
	<meta charset="utf-8">
	<meta name="description" content="TIGENIUS"/>
	<meta name="keywords" content="TIGENIUS, ti"/>
	<meta name="author" content="Vinícius de Souza Gonçalves"/>
	<meta http-equiv="Content-Language" content="pt-br" />
	<!-- pagina de cadastro de usuarios -->
	<title>TI.GENIUS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet">

	<script src="<?= base_url(); ?>assets/vendors/select/bootstrap-select.min.js"></script>

	<script src="<?= base_url(); ?>assets/js/forms.js"></script>

	<script>
        //Funcao adiciona uma nova linha na tabela
        var qtd = 0;
        function adicionaLinha(idTabela) {
        	var tabela = document.getElementById(idTabela);
        	var numeroLinhas = tabela.rows.length;
        	var linha = tabela.insertRow(numeroLinhas);
        	var celula1 = linha.insertCell(0);
        	var celula2 = linha.insertCell(1); 
        	celula1.innerHTML = "<input maxlength='50' class='form-control' type='text' id='Valor"+qtd+"' name='Valor"+qtd+"' placeholder='Valor' required>"; 
        	celula2.innerHTML =  "<button class='btn btn-danger btn-xs' onclick='removeLinha(this)'><i class='glyphicon glyphicon-remove'></i> Remover</button>";
        	qtd++;  
        	document.getElementById('qtd').value = qtd;
        }
        
        // funcao remove uma linha da tabela
        function removeLinha(linha) {
        	qtd--;
        	var i=linha.parentNode.parentNode.rowIndex;
        	document.getElementById('tabela').deleteRow(i);
        	document.getElementById('qtd').value = qtd;
        }            
    </script> 
</head>
<body>
	<?php $this->load->view("menu_lateral") ?>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<h6>Cadastro de Variáveis <br><button style="border: none;" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-info-sign"></i> Info</button></h6>

							<!-- Modal -->
							<div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Cadastro de Variáveis</h4>
										</div>
										<div class="modal-body">
											<p>Nesta página é realizado o cadastro de variáveis utilizadas na construção das regras de produção.
												<br><br><strong>Nome da Variável:</strong> Campo para dar um nome para a variável.<br> <strong>Ex:</strong> Usuário.
												<br><br><strong>Pergunta:</strong> Campo para colocar uma pergunta que será relacionada a essa variável. <br> <strong>Ex:</strong> Qual o seu tipo de usuário?.
												<br><br><strong>Adicionar Valores:</strong> Botão para adicionar valores, que corresponde as valores que essa variável terá. Utilizado como respostas dos usuários que procuram uma solução.<br> <strong>Ex: Tipos de Usuário <br></strong> Aluno <br> Servidor</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Apenas administrador tem acesso a cadastro de usuarios-->
								<!-- abre form -->
								<?php if($nivelAcesso == "Administrador"){
									if($msg = get_msg()):
										echo '<div class="msg-box"><b>'.$msg.'</b></div>';
										echo '<br><br>';
									endif;
									echo form_open_multipart('Variaveis/AddVariavel'); ?>
									<p style="font-size: 14px;"><strong>Nome da Variável</strong></p>
									<input maxlength="50" class="form-control" type="text" id="Nome" name="Nome" value="<?php if($nmVariavel != ''){ echo $nmVariavel;}  ?>" placeholder="Nome da Variável" required>
									<br>
									<p style="font-size: 14px;"><strong>Pergunta</strong></p>
									<input maxlength="200" class="form-control" type="text" id="Pergunta" name="Pergunta" value="<?php if($pergunta != ''){ echo $pergunta;}  ?>" placeholder="Pergunta para essa variável" >
									<br>
									<input class="form-control" type="hidden" id="qtd" name="qtd" value="<?php if($qtd != ''){ echo $qtd; } ?>">
									<br>
									<!-- adiciona valor do input na variavel -->
									<a class="btn btn-primary" onclick="adicionaLinha('tabela', 'Valor')">Adicionar Valores</a>
									<br><br><br>
									<div class="table-responsive">
										<table class="table" id="tabela" name="tabela">
											<thead class="col-md-12">
												<tr>
													<th>Valores</th>
													<th></th>
												</tr>

											</thead>
											<tbody class="col-md-12">

												<!-- cria tabela dinamicamente de acordo com a qtde de variaveis -->

											</tbody>
										</table>
									</div>

									<div class="action">
										<button class="btn btn-primary signup" type="submit" >Confirmar</button>
									</div>
									<br><br><br>
									<?php echo form_close();
								}
								?>
								<!--fecha form -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>




		<link href="<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?= base_url(); ?>assets/js/jquery-1.11.1.js"></script>
		<!-- jQuery UI -->
		<script src="<?= base_url(); ?>assets/js/jqueri-ui-1.10.3.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

		<script src="<?= base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

		<script src="<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.js"></script>

		<script src="<?= base_url(); ?>assets/js/custom.js"></script>
		<script src="<?= base_url(); ?>assets/js/tables.js"></script>
	</body>

	</html>

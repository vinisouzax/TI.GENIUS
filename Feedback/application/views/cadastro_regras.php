
<html>
<!-- TELA DE CADASTRO DE REGRAS-->

<head>
	<meta charset="utf-8">
	<meta name="description" content="TIGENIUS"/>
	<meta name="keywords" content="TIGENIUS, ti"/>
	<meta name="author" content="Vinícius de Souza Gonçalves"/>
	<meta http-equiv="Content-Language" content="pt-br" />
	<!-- pagina de cadastro de REGRAS -->
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
        	var celula3 = linha.insertCell(2);
        	var celula4 = linha.insertCell(3);
        	var celula5 = linha.insertCell(4);
        	var arrayVariaveis = <?=json_encode($variaveis)?>;
        	celula1.innerHTML = "<p></p>SE";
        	celula2.innerHTML = "<select class='form-control' id='Variavel"+qtd+"' name='Variavel"+qtd+"' onchange='setaValores(this.value, this.id);' required></select>"; 
        	celula3.innerHTML = "<p></p>=";
        	celula4.innerHTML = "<select class='form-control' id='Valor"+qtd+"' name='Valor"+qtd+"' required></select>"; 
        	celula5.innerHTML =  "<button class='btn btn-danger btn-xs' onclick='removeLinha(this)'><i class='glyphicon glyphicon-remove'></i> Remover</button>";  

        	var select1 = document.getElementById("Variavel"+qtd);
        	
        	var length = select1.options.length;
        	
        	var i;
        	
        	var option = document.createElement("option");
        	option.value = "";
        	option.text = 'Selecione a variavel';
        	select1.add(option);			
        	for (i = 0; i < arrayVariaveis.length; i++){
        		var option = document.createElement("option");
        		option.value = arrayVariaveis[i].idVariavel;
        		option.text = arrayVariaveis[i].nmVariavel;
        		select1.add(option);
        	}

        	var select2 = document.getElementById("Valor"+qtd);
        	
        	var option = document.createElement("option");
        	option.value = "";
        	option.text = 'Selecione o valor';
        	select2.add(option);			

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

        function setaValores(valor, id){
        	var arrayValores = <?=json_encode($valores)?>; 
        	var id = id.replace("Variavel","");
        	var select2 = document.getElementById("Valor"+id);
        	
        	var length = select2.options.length;
        	
        	var i;
        	
        	for(i = select2.options.length - 1; i >= 0; i--)
        	{
        		select2.remove(i);
        	}
        	var option = document.createElement("option");
        	option.value = "";
        	option.text = 'Selecione o valor';
        	select2.add(option);			
        	if(valor >= 1){
        		for (i = 0; i < arrayValores.length; i++){
        			if(arrayValores[i].idVariavel == valor){
        				var option = document.createElement("option");
        				option.value = arrayValores[i].idValor;
        				option.text = arrayValores[i].nmValor;
        				select2.add(option);
        			}
        		}
        	}          
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
							<h6>Cadastro de Regras <br><button style="border: none;" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-info-sign"></i> Info</button></h6>
							<!-- Trigger the modal with a button -->
							

							<!-- Modal -->
							<div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Cadastro de Regras</h4>
										</div>
										<div class="modal-body">
											<p>Nesta página é realizado o cadastro de regras de produção.
												<br><br><strong>Nome da Regra:</strong> Campo para dar um nome para a regra.<br> <strong>Ex:</strong> Redefinir senha E-mail Aluno.
												<br><br><strong>Categoria do Problema:</strong> Campo para selecionar o tipo de problema.<br> <strong>Ex:</strong> E-mail.
												<br><br><strong>Solução:</strong> Campo para colocar tutorial em formato .pdf para resolver o problema. Tamanho Máximo suportável para os arquivo é de 24Mb.<br> <strong>Ex:</strong> Tutorial_Email_Aluno.pdf.
												<br><br><strong>Adicionar Condições:</strong> Botão para adicionar condições, que corresponde as variaveis utilizadas para formar a regra.<br> <strong>Ex: Redefinir senha de E-mail Discente <br></strong> SE E-mail = Redefinir senha<br>SE Usuario = Aluno</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Apenas administrador tem acesso a cadastro de regras-->
								<!-- abre form -->
								<?php if($nivelAcesso == "Administrador"){
									if($msg = get_msg()):
										echo '<div class="msg-box"><b>'.$msg.'</b></div>';
										echo '<br><br>';
									endif;
									echo form_open_multipart('Regras/AddRegra'); ?>
									<p style="font-size: 14px;"><strong>Nome da Regra</strong></p>
									<input maxlength="50" class="form-control" type="text" id="Nome" name="Nome" value="<?php if($nmRegra != ''){ echo $nmRegra;}  ?>" placeholder="Nome da Regra" required>
									<p style="font-size: 14px;"><strong>Categoria de Problema</strong></p>
									<select class="form-control col-md-12" id="Categoria" name="Categoria" required>
										<?php
										echo "<option value=''>Selecione a categoria</option>";
										foreach($categorias as $categoria){ 
											if($idCategoria != ""){ ?>
												<option value="<?= $categoria->idCategoria; ?>" <?=($categoria->idCategoria == $idCategoria)? 'selected':''?>> <?= $categoria->nmCategoria; ?> </option>
												
												<?php
											}
											else{
												echo "<option value=$categoria->idCategoria>$categoria->nmCategoria</option>";
											}
										}
										?>
									</select>
									<br><br><br>
									<p style="font-size: 14px;"><strong>Solução (Pdf)</strong></p>
									<input type="file" id="solucao" name="solucao" class="solucao form-control" required/>
									<input class="form-control" type="hidden" id="qtd" name="qtd" value="<?php if($qtd != ''){ echo $qtd; } ?>">
									<br><br>
									<!-- adiciona variavel do input na regra -->
									<a class="btn btn-primary" onclick="adicionaLinha('tabela', 'Valor')">Adicionar Condições</a>
									<br><br><br>
									<div class="table-responsive">
										<table class="table" id="tabela" name="tabela">
											<thead class="col-md-12">
												<tr>
													<th></th>
													<th>Variaveis</th>
													<th></th>
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

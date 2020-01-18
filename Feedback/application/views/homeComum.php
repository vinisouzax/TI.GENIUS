<html>
<!-- PAGINA PRINCIPAL-->
<head>
	<meta charset="utf-8">
	<meta name="description" content="TIGENIUS"/>
	<meta name="keywords" content="TIGENIUS, ti"/>
	<meta name="author" content="Vinícius de Souza Gonçalves"/>
	<meta http-equiv="Content-Language" content="pt-br" />
	<title>TI.GENIUS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery UI -->
	<link href="<?= base_url(); ?>assets/css/jquery-ui-1.10.3-2013-05-03.css" rel="stylesheet" media="screen">

	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?= base_url(); ?>assets/js/jquery-1.11.1.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
	<!-- jQuery UI -->
	<script src="<?= base_url(); ?>assets/js/jqueri-ui-1.10.3.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-table.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.quick.search.js"></script>

	
	<script>

		$("document").ready(function() {	

			var variaveis = <?=json_encode($variaveis)?>;
			var valores = <?=json_encode($valores)?>;
			var regras = <?=json_encode($regras)?>;
			var regrasxvariaveis = <?=json_encode($regrasxvariaveis)?>;

			$("#per").hide();
			$("#perguntas").hide();
			$("#btnConfirmar").hide();

			//primeiro select com primeira pergunta sobre a categoria de problema, pega os problemas apenas
			//daquela categoria selecionada
			$("#txt1").change(function(){
				var categoria = $("#txt1 option:selected").val();
				$("#txt1").hide();
				$("#perprimeiro").hide();
				adicionaLinha($("#perprimeiro").text(), $("#txt1 option:selected").text());
				$("#reinicia").show();
				variaveis = <?=json_encode($variaveis)?>;
				valores = <?=json_encode($valores)?>;
				regras = <?=json_encode($regras)?>;
				regrasxvariaveis = <?=json_encode($regrasxvariaveis)?>;
				$("#perguntas").fadeIn();
				if(categoria >= 1){
					console.log(regras.length);
					for(var i = 0; i < regras.length; i++){
						
						if(regras[i].idCategoria != categoria){
							regras.splice(i, 1);
							i = -1;
						}
					}
					for(var i = 0; i < regras.length; i++){
						console.log(regras[i].nmRegra);
					}
					for(var i = 0; i < regrasxvariaveis.length; i++){
						var v = true;
						for(var j = 0; j < regras.length; j++){
							if(regras[j].idRegra == regrasxvariaveis[i].idRegra){
								v = false;
								break;
							}
						}
						if(v == true){
							regrasxvariaveis.splice(i, 1);
							i = -1;
						}
					}
					for(var j = 0; j < variaveis.length; j++){
						if(variaveis[j].idVariavel == regrasxvariaveis[0].idVariavel){
							$("#per").empty().append(variaveis[j].pergunta).fadeIn();
						}
					}
					
					var select = document.getElementById("perguntas");
					select.onchange = function(){resposta(select.id, select.value);};
					var length = select.options.length;
					
					for(var j = select.options.length - 1; j >= 0; j--)
					{
						select.remove(i);
					}		
					for (var j = 0; j < valores.length; j++){
						if(valores[j].idVariavel == regrasxvariaveis[0].idVariavel){
							var option = document.createElement("option");
							option.value = valores[j].idValor;
							option.text = valores[j].nmValor;
							select.add(option);
						}
					}

				}
			});
			//select novo com novas perguntas que se encontram em regras de produção de determinada
			//categoria de problema, a cada pergunta respondida, são cortadas as regras não necessárias
			//até que sobre apenas uma regra
			function resposta(id, valor){
				$('#divQuestoes').fadeOut().fadeIn();
				var select = document.getElementById("perguntas");
				var length = select.options.length;
				adicionaLinha($("#per").text(), document.getElementById("perguntas").options[document.getElementById("perguntas").selectedIndex].text);
								
				for(var j = select.options.length - 1; j >= 0; j--)
				{
					select.remove(i);
				}	
				var option = document.createElement("option");
				option.value = "";
				option.text = "Selecione uma opção";
				select.add(option);

				var r = [];
				console.log("aqui");
				if(regras.length > 1){
					for (var i = 0; i < regrasxvariaveis.length; i++){
						console.log(regrasxvariaveis[i].idRegra);
						if(regrasxvariaveis[i].idValor == valor){
							console.log("entrou");
							r.push(regrasxvariaveis[i]);
							/*var idVariavel = regrasxvariaveis[i].idVariavel;
							for(var j = 0; j < regrasxvariaveis.length; j++){
								if(regrasxvariaveis[j].idVariavel == idVariavel){
									regrasxvariaveis.splice(j, 1);
									j = -1;
								}
							}
							i = -1;*/
						}
					}
					for(var i = 0; i < r.length; i++){
						var idVariavel = r[i].idVariavel;
						for(var j = 0; j < regrasxvariaveis.length; j++){
							if(regrasxvariaveis[j].idVariavel == idVariavel){
								regrasxvariaveis.splice(j, 1);
								j = -1;
							}
						}
					}
					/*console.log("depois");
					for(var i = 0; i < r.length; i++){
						console.log(r[i].idRegraXVariavel);
					}*/
					for (var i = 0; i < regras.length; i++){
						var v = true;
						for(var j = 0; j < r.length; j++){
							if(r[j].idRegra == regras[i].idRegra){
								v = false;
								break;
							}
						}
						if(v == true){
							regras.splice(i, 1);
							i = -1;
						}
					}
					for(var i = 0; i < regras.length; i++){
						console.log(regras[i].nmRegra);
					}
					if(regras.length > 1){
						for(var j = 0; j < variaveis.length; j++){
							if(variaveis[j].idVariavel == regrasxvariaveis[0].idVariavel){
								$("#per").empty().append(variaveis[j].pergunta);
							}
						}	
						for (var j = 0; j < valores.length; j++){
							if(valores[j].idVariavel == regrasxvariaveis[0].idVariavel){
								var option = document.createElement("option");
								option.value = valores[j].idValor;
								option.text = valores[j].nmValor;
								select.add(option);
							}
						}	
					}else{
						//console.log(regras[0].idRegra);
						$("#perguntas").hide();
						$("#per").empty().append("<h6><strong>Para a ver a solução de seu problema clique no botão abaixo:</strong></h6>");
						$("#btnConfirmar").show();						
					}		
				}else{
					//console.log(regras[0].idRegra);
					$("#perguntas").hide();
					$("#per").empty().append("<h6><strong>Para a ver a solução de seu problema clique no botão abaixo:</strong></h6>");
					$("#btnConfirmar").show();
					
				}
			}

	        function adicionaLinha(per, valor) {
	        	var tabela = document.getElementById("tabela");
	        	var numeroLinhas = tabela.rows.length;
	        	var linha = tabela.insertRow(numeroLinhas);
	        	var celula1 = linha.insertCell(0);
	        	var celula2 = linha.insertCell(1); 
	        	celula1.innerHTML = "<p>"+per+"</p>";
	        	celula2.innerHTML = "<p>"+valor+"</p>";

	        }
			
			$("#btnConfirmar").click(function(){
				if(regras.length == 0){
					$("#tutorial").empty().append("<p style='font-size: 20px;'>Este problema necessita de um contato com um profissional de suporte. <a href='http://glpi.pas.ifsuldeminas.edu.br/glpi/' target='_blank'>Clique aqui</a> para requisitar uma demanda no GLPI </p>");
				}
				else{
					$("#tutorial").empty().append("<iframe style='width:100%; height: 100%;' src='"+regras[0].solucao+"'></iframe>");
				}
			});

		});

function reiniciaModelo(){
	location.reload();
}	
</script>
<style>
#btnConfirmar {
	text-transform: uppercase;
	outline: 0;
	width: 100%;
	border: 0;
	padding: 15px;
	font-size: 14px;
	-webkit-transition: all 0.3 ease;
	transition: all 0.3 ease;
	cursor: pointer;
}
#btnConfirmar:hover,.form #btnConfirmar:active,.form #btnConfirmar:focus {
	color: yellow;
}

#btnReiniciar {
	text-transform: uppercase;
	outline: 0;
	width: 100%;
	border: 0;
	padding: 15px;
	font-size: 14px;
	-webkit-transition: all 0.3 ease;
	transition: all 0.3 ease;
	cursor: pointer;
}

#btnReiniciar:hover,.form #btnReiniciar:active,.form #btnReiniciar:focus {
	color: yellow;
}

p{
	font-size: 14px;
	color: black;
}

</style>

</head>
<body>
	<?php $this->load->view("menu_lateral") ?>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-8 col-md-offset-1" >
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<h6>Olá, Seja Bem Vindo ao Sistema Especialista TI.GENIUS</h6>
							<div class="table-responsive">
								<table class="table" id="tabela" name="tabela">
									<thead class="col-md-12">
										<tr>
											<th>Pergunta</th>
											<th>Resposta</th>
										</tr>

									</thead>
									<tbody class="col-md-12">

										<!-- cria tabela dinamicamente de acordo com a qtde de variaveis -->

									</tbody>
								</table>
							</div>
							<!-- Apenas administrador tem acesso a cadastro de usuarios-->
							<!-- abre form -->
							<strong><p id="perprimeiro">Qual a categoria do problema?</p></strong>

							<select class="form-control col-md-12" id="txt1" name="txt1" required>
								<?php
								echo "<option value=''>Selecione o problema</option>";
								foreach($categorias as $categoria){
									echo "<option value=$categoria->idCategoria>$categoria->nmCategoria</option>";
								}
								?>
							</select>
							<div id="divQuestoes">
								<strong><p id="per"></p></strong>
								<select class="form-control col-md-12" id="perguntas" name="perguntas" required>
									<option value="">Selecione uma opção</option>
								</select>
								<div class="action">
									<button style="border: none;" type="button" class="btn btn-success signup" data-toggle="modal" data-target="#modalTutorial" id="btnConfirmar" >Ver solução</button>
								</div>
								<div class="action">
									<button style="border: none;" type="button" class="btn btn-primary signup" id="btnReiniciar" onclick="reiniciaModelo()">Início</button>
								</div>
							</div>
							<br><br><br><br><br>
							<!--fecha form -->
						</div>
						<div class="content-wrap" >
							<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfjGHGLYeyEfqsqTitmAnt2mhIi9YETX_hMMRKf1htHkv-HLg/viewform?embedded=true" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0">Carregando…</iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div    class = "modal fade" id = "modalTutorial" role = "dialog">
		<div    class = "modal-dialog modal-lg" style="width: 90vw; height: 80vh;">
			<div    class = "modal-content">
				<div    class = "modal-header">
					<button type  = "button" class  = "close" data-dismiss = "modal">&times;</button>
					<h4     class = "modal-title">Tutorial</h4>
				</div>
				<div id = "tutorial" class = "modal-body">

				</div>
				<div    class = "modal-footer">
					<button type  = "button" class = "btn btn-default" data-dismiss = "modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
	<br><br><br><br><br>

	<?php $this->load->view('rodape'); ?>

	<link href="<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

	<script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?= base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.min.js"></script>

	<script src="<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.js"></script>

	<script src="<?= base_url(); ?>assets/js/custom.js"></script>
	<script src="<?= base_url(); ?>assets/js/tables.js"></script>
</body>
</html>

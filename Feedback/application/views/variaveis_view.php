	<?php $this->load->view('head')?>
	//excluir variavel
	function confirma_excluir(idVariavel){
	var apagar = confirm('Você deseja excluir esta variavel');
	if (apagar){
	location.href = '<?php echo base_url("Variaveis/DeleteVariavel") ?>/'+ idVariavel;
}
}
</script>
</head>
<body>
	<?php $this->load->view("menu_lateral") ?>


	<div class="col-md-10">
		<div class="panel-heading">
			<div class="panel-title">Variáveis</div>

			<div style="float: right;" ><a href="<?php echo base_url('Variaveis/mostra_cadastro_variavel') ?>" class="btn btn-info">Nova Variavel</a> </div>
		</div>
		<br><br>
		<?php
			//se existe uma mensagem vinda do controller
		if($msg = get_msg()){
			echo '<div class="msg-box"><center> <b>'.$msg.'</b></center></div>';
		}
		?>
		<br><br>
		<section>
			<div class="demo-html"></div>
			<table id="example" class="display" style="width:100%; font-size: 12px;">
				<thead>
					<tr>
						<th>Nome de Variável</th>
						<th>Pergunta</th>
						<th>Valores</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>

				</thead>
				<tbody>
					<!-- cria tabela dinamicamente de acordo com a qtde de variaveis -->
					<?php
					foreach ($variaveis as $variavel) {

						echo '<tr class="odd gradeX">';
						echo '<td>' . $variavel->nmVariavel . '</td>';
						echo '<td>' . $variavel->pergunta . '</td>';
						echo '<td>';
						foreach ($valores as $valor){
							if($valor->idVariavel == $variavel->idVariavel)
								echo $valor->nmValor.'<br>';
						}
						echo '</td>';
						echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditVariavel/' . $variavel->idVariavel . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
						echo '<td class="center"><a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $variavel->idVariavel . ');"><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
						echo '</tr>';

					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Nome de Variável</th>
						<th>Pergunta</th>
						<th>Valores</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<?php $this->load->view('rodape'); ?>
</body>

</html>
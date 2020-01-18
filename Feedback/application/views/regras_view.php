<?php $this->load->view('head')?>
//excluir regra
function confirma_excluir(idRegra){
var apagar = confirm('Você deseja excluir esta regra');
if (apagar){
location.href = '<?php echo base_url("Regras/DeleteRegra") ?>/'+ idRegra;
}
}
</script>
</head>
<body>
	<body>
		<?php $this->load->view("menu_lateral") ?>
		<div class="col-md-10">
			<div class="panel-heading">
				<div class="panel-title">Regras</div>

				<div style="float: right;" ><a href="<?php echo base_url('Regras/mostra_cadastro_regras') ?>" class="btn btn-info">Nova Regra</a> </div>
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
							<th>Nome da Regra</th>
							<th>Categoria</th>
							<th>Solução</th>
							<th>Editar</th>
							<th>Excluir</th>
						</tr>

					</thead>
					<tbody>
						<!-- cria tabela dinamicamente de acordo com a qtde de regras -->
						<?php
						foreach ($regras as $regra) {

							echo '<tr class="odd gradeX">';
							echo '<td>' . $regra->nmRegra . '</td>';
							foreach($categorias as $categoria){
								if($categoria->idCategoria == $regra->idCategoria){
									echo '<td>'. $categoria->nmCategoria . '</td>';
									break;
								}
							}
							echo '<td>'. str_replace(base_url()."tutoriais/", "", $regra->solucao) .'</td>';
							echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditRegra/' . $regra->idRegra . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
							echo '<td class="center"><a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $regra->idRegra . ');"><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
							echo '</tr>';

						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>Nome da Regra</th>
							<th>Categoria</th>
							<th>Solução</th>
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

<?php $this->load->view('head')?>
//excluir categoria
function confirma_excluir(idCategoria){
var apagar = confirm('Você deseja excluir esta categoria');
if (apagar){
location.href = '<?php echo base_url('Categorias/deletecategoria') ?>/'+ idCategoria;
}
}
</script>
</head>
<body>
	<?php $this->load->view("menu_lateral") ?>

	<div class="col-md-10">
		<div class="panel-heading">
			<div class="panel-title">Categorias</div>

			<div style="float: right;" ><a href="<?php echo base_url('Categorias/mostra_cadastro_categoria') ?>" class="btn btn-info">Nova Categoria</a> </div>
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
						<th>Nome da Categoria</th>
						<th>Editar</th>
						<th>Excluir</th>
					</tr>

				</thead>
				<tbody>
					<!-- cria tabela dinamicamente de acordo com a qtde de categorias -->
					<?php
					foreach ($categorias as $categoria) {

						echo '<tr class="odd gradeX">';
						echo '<td>' . $categoria->nmCategoria . '</td>';
						echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditCategoria/' . $categoria->idCategoria . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
						echo '<td class="center"><a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $categoria->idCategoria . ');"><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
						echo '</tr>';

					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Nome da Categoria</th>
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

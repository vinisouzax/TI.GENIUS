
<html>
<!-- TELA DE CADASTRO DE categoria-->

<head>
	<meta charset="utf-8">
	<meta name="description" content="TIGENIUS"/>
	<meta name="keywords" content="TIGENIUS, ti"/>
	<meta name="author" content="Vinícius de Souza Gonçalves"/>
	<meta http-equiv="Content-Language" content="pt-br" />
	<!-- pagina de cadastro de categorias -->
	<title>TI.GENIUS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet">

	<script src="<?= base_url(); ?>assets/vendors/select/bootstrap-select.min.js"></script>

	<script src="<?= base_url(); ?>assets/js/forms.js"></script>

</head>
<body>
	<?php $this->load->view("menu_lateral") ?>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<h6>Cadastro de Categoria<br>				  
								<button style="border: none;" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-info-sign"></i> Info</button></h6>

								<!-- Modal -->
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Cadastro de Categorias de Problemas</h4>
											</div>
											<div class="modal-body">
												<p>Nesta página é realizado o cadastro de categorias de problemas utilizadas na construção das regras de produção.
													<br><br><strong>Nome da Categoria:</strong> Campo para dar um nome para a categoria de problema.<br> <strong>Ex:</strong> E-mail.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Apenas administrador tem acesso a cadastro de categorias-->
									<!-- abre form -->
									<?php if($nivelAcesso == 'Administrador'){
										echo form_open_multipart('Categorias/addcategoria'); ?>
										<input class="form-control" type="text" id="Nome" name="Nome" value="<?php if($nmCategoria != ''){ echo $nmCategoria;}  ?>" placeholder="Nome da Categoria" required>

										<div class="action">
											<button class="btn btn-primary signup" type="submit" >Confirmar</button>
										</div>
										<?php echo form_close();
									}
									?>
									<br><br>
									<?php
									if($msg = get_msg()):
										echo '<div class="msg-box"><b>'.$msg.'</b></div>';
									endif;
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

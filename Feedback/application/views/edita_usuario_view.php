
<html>
<!-- TELA PARA EDITAR DADOS DE USUARIO-->
<head>
	<meta charset="utf-8">
	<meta name="description" content="TIGENIUS"/>
	<meta name="keywords" content="TIGENIUS, ti"/>
	<meta name="author" content="Vinícius de Souza Gonçalves"/>
	<meta http-equiv="Content-Language" content="pt-br" />
	<!-- Pagina de edicao de usuarios -->
	<title>TI.GENIUS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet">

</head>
<body>
	<?php $this->load->view("menu_lateral") ?>

	<!-- formulario de edicao de usuarios -->
	<div class="page-content container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<h6>Edição de Usuário</h6>
							<!-- abre form-->
							<?php echo form_open_multipart('Admin_usuario/Updateusuario'); ?>
							<input  type="hidden" id="IdUsuario" name="IdUsuario" value="<?php echo isset($usuario) ? $usuario->idUsuario : -1; ?>">
							<input maxlength="45" class="form-control" type="text" id="Login" name="Login" placeholder="Nome de Login" 
							value="<?php echo isset($usuario) ? $usuario->nmLogin : ''; ?>" required>
							<input maxlength="200" class="form-control" type="text" id="Usuario" name="Usuario" placeholder="Nome Completo"
							value="<?php echo isset($usuario) ? $usuario->nmUsuario : ''; ?>" required>
							<input maxlength="45" class="form-control" type="password" id="Senha" name="Senha" placeholder="Senha" required>
							<input maxlength="45" class="form-control" type="password" id="Confirme_Senha" name="Confirme_Senha" placeholder="Confirme a Senha" required>
							<input maxlength="100" class="form-control" type="email" id="Email" name="Email" placeholder="Email" 
							value="<?php echo isset($usuario) ? $usuario->email : ''; ?>"required>
							<br>
							<div class="col-md-12">
								<!--nivel de acesso de um usuario so pode ser alterado por um administrador -->
								<?php
								if($nivelAcesso == "Administrador"){
									?>
									<select class="form-control" id="Acesso" name="Acesso" required>
										<option value=''>Selecione o Acesso</option>
										<option value="Administrador" <?=($usuario->nivelAcesso == "Administrador")? 'selected':''?>>Administrador</option>
										<option value="Servidor/Discente" <?=($usuario->nivelAcesso == "Servidor/Discente")? 'selected':''?>>Servidor/Discente</option>
									</select> 
									<?php
								}else{
									?> 
									<!-- caso nao seja administrador o select fica desabilitado -->
									<select class="form-control" id="Acesso" name="Acesso" readonly>
										<option value='' disabled="disabled">Selecione o Acesso</option>
										<option value="Administrador" <?=($usuario->nivelAcesso == "Administrador")? 'selected':''?> disabled="disabled">Administrador</option>
										<option value="Servidor/Discente" <?=($usuario->nivelAcesso == "Servidor/Discente")? 'selected':''?>>Servidor/Discente</option>
									</select> '							
									<?php
								}
								?>

							</div>
							
							<br><br><br>

							<?php //mensagem de erro
							echo "<div align=center>";
							if (isset($message_display)) {
								echo $message_display;
							}
							echo validation_errors();
							echo "</div>";
							?>
							<div class="action">
								<button class="btn btn-primary signup" type="submit" >Confirmar</button>
							</div>        
							<?php echo form_close(); ?> 
							<!--fecha form -->     
							<br><br><br>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- fim formulario edicao-->


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
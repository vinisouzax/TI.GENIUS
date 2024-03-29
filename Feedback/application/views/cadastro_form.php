
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

</head>
<body>
	<?php $this->load->view("menu_lateral") ?>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="login-wrapper">
					<div class="box">
						<div class="content-wrap">
							<h6>Cadastro de Usuário</h6>
							<!-- Apenas administrador tem acesso a cadastro de usuarios-->
							<!-- abre form -->
							<?php if($nivelAcesso == 'Administrador'){
								echo form_open_multipart('Admin_usuario/addusuario'); ?>
								<p style="font-size: 14px;"><strong>Nome de Login</strong></p>
								<input maxlength="45" class="form-control" type="text" id="Login" name="Login" value="<?php if($Login != ''){ echo $Login;}  ?>" placeholder="Nome de Login" required>
								<p style="font-size: 14px;"><strong>Nome do Usuário</strong></p>
								<input maxlength="200" class="form-control" type="text" id="Usuario" name="Usuario" value="<?php if($Usuario != ''){ echo $Usuario;}  ?>" placeholder="Nome Completo" required>
								<p style="font-size: 14px;"><strong>Senha</strong></p>
								<input maxlength="45" class="form-control" type="password" id="Senha" name="Senha" placeholder="minímo de 8 caracteres" required>
								<p style="font-size: 14px;"><strong>Confirme a Senha</strong></p>
								<input maxlength="45" class="form-control" type="password" id="Confirme_Senha" name="Confirme_Senha" placeholder="Confirme a Senha" required>
								<p style="font-size: 14px;"><strong>E-mail</strong></p>
								<input maxlength="100" class="form-control" type="email" id="Email" name="Email"  value="<?php if($email != ''){ echo $email;}  ?>" placeholder="ex: vinicius@gmail.com" required>
								<br>
								<div class="col-md-12">

									<select class="form-control" id="Acesso" name="Acesso" required>
										<option value=''>Selecione o Acesso</option>
										<option value="Administrador">Administrador</option>
										<option value="Servidor/Discente">Servidor/Discente</option>
									</select>

								</div>
								<br><br><br>

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
							<br><br><br>
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

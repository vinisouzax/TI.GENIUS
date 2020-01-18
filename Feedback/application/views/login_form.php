<?php $this->load->view('head_painel'); ?>

<div class="container">
	<h1 class="welcome text-center"><img src="<?=base_url()?>assets/logo.png"></h1>
	<div class="card card-container">
		<h2 class='login_title text-center'>Login</h2>
		<hr>
		<div class="form-signin" style="text-align: center;" >
			<?php 
			if($msg = get_msg()):
				echo '<div class="msg-box">'.$msg.'</div>';
			endif;
			echo form_open('Autenticacao/login');
			echo form_label('Usuário:', 'login', array('class' => 'input_title'));
			echo form_input('login',set_value('login'),array('autofocus' => 'autofocus', 'placeholder' => 'Login ou E-mail'));
			echo form_label('Senha:', 'senha', array('class' => 'input_title'));
			echo form_password('senha');
			?>
			<br>
			<?php
			echo form_submit('enviar', 'LOGIN', array('class' => 'btn btn-secondary btn-lg', 'id'=>'btnEntrar'));

			echo form_close();
			?>			
		</div>
	</div>
</div>
</body>
</html>
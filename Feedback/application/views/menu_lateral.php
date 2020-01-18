<div style="margin: 0 auto; text-align: center" class="page-header">
  <img src="<?=base_url()?>assets/logo.png">      
</div> 
<div class="col-md-2">
  <div class="sidebar content-box" style="display: block;">
    <ul class="nav">
      <!-- Main menu -->
      <?php if($nivelAcesso == "Administrador"){ ?>
        <li class="current"><a href="<?php echo base_url('Home/index') ?>"><i class="glyphicon glyphicon-home"></i> Home</a></li>
        <!--  <li><a href="<?php //echo base_url('docportaria/portarias') ?>"><i class="glyphicon glyphicon-pencil"></i> Portarias</a></li>-->
        <li class="submenu">
         <a href="#">
          <i class="glyphicon glyphicon-list"></i> Base de Dados
          <span class="caret pull-right"></span>
        </a>
        <!-- Sub menu -->
        <ul>
          <li><a href="<?php echo base_url('Categorias/index') ?>">Gerenciamento de Categorias</a></li>
          <li><a href="<?php echo base_url('Regras/index') ?>">Gerenciamento de Regras</a></li>
          <li><a href="<?php echo base_url('Variaveis/index') ?>">Gerenciamento de Variáveis</a></li>
        </ul>
      </li>  

      <li class="submenu">
       <a href="#">
         <i class="glyphicon glyphicon-user"></i> <?php echo $nmLogin?>
         <span class="caret pull-right"></span>
       </a>
       <!-- Sub menu -->
       <ul>
        <li><a href="<?php echo base_url('Admin_usuario/index') ?>"><i class="glyphicon glyphicon-user"></i> Meu Perfil </a></li>
        <li><a href="<?php echo base_url('Autenticacao/logout') ?>"><i class="glyphicon glyphicon-off"></i> Sair</a></li><!-- LOGOUT--> 
      </ul>
    <?php } ?>
    <li><a href="http://glpi.pas.ifsuldeminas.edu.br/glpi/"><i class="glyphicon glyphicon-wrench"></i> GLPI</a></li>
  </li>  
</ul>
</div>
</div>
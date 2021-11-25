<!-- Navbar (sit on top) -->
<?php 
?>
   
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="menuPrincipal">
    <a href="./index.php" class="w3-bar-item w3-button w3-wide"><b>CG</b></a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      
     
     
      <?php if (isset($_SESSION["UTILIZADOR"]) ) { ?>
                      <a href="#noticias" class="w3-bar-item w3-button"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">newspaper</i> Notícias</a>
                      <a href="#minhasimagens" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Minhas imagens</a>
    
                      <?php 
                      if (isset($_SESSION["NIVEL_UTILIZADOR"])) { 
                         if ($_SESSION["NIVEL_UTILIZADOR"]==2 ) { ?>
                         	<a href="userGerirUtilizadores.php" class="w3-bar-item w3-button"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">people_alt</i>Gerir utilizadores</a>
                      <?php }
                      }    
                      ?> 
              		<a href="userSair.php" class="w3-bar-item w3-button"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">logout</i> Sair [<b><?php echo $_SESSION["UTILIZADOR"];?></b>]</a>
              		<a href="userEditarConta.php" class="w3-bar-item w3-button"><i class="material-icons">settings</i></a>
              	 
      <?php } else { ?>
          
      		<a href="userEntrar.php" class="w3-bar-item w3-button"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">login</i> Entrar</a>
      <?php } ?>
      
        
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>



<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="menuLateral">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Fechar ×</a>
  
  
   <?php if (isset($_SESSION["UTILIZADOR"]) ) { ?>
  
         <a href="#noticias" onclick="w3_close()" class="w3-bar-item w3-button">Notícias</a>
   
         <a href="#minhasimagens" onclick="w3_close()" class="w3-bar-item w3-button">Minhas imagens</a>
   
   
      	 <?php 
                      if (isset($_SESSION["NIVEL_UTILIZADOR"])) { 
                         if ($_SESSION["NIVEL_UTILIZADOR"]==2 ) { ?>
                              <a href="userGerirUtilizadores.php" onclick="w3_close()" class="w3-bar-item w3-button">Gerir utilizadores</a>
         <?php           }
                      }
         ?>
   
   
        <a href="userSair.php" onclick="w3_close()" class="w3-bar-item w3-button">Sair [<b><?php echo $_SESSION["UTILIZADOR"];?></b>]</a>
        <a href="userEditarConta.php" onclick="w3_close()" class="w3-bar-item w3-button">Editar conta</a>
 
  <?php } else { ?>
  		 <a href="userEntrar.php" onclick="w3_close()" class="w3-bar-item w3-button">Entrar</a>
  <?php } ?>
 
  
 
 
</nav>

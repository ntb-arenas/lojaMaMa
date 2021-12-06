<?php  
error_reporting(E_ERROR | E_PARSE); 
session_start();

// to see all errors:
 ini_set('display_errors', '1');
 ini_set('display_startup_errors', '1');
 error_reporting(E_ALL);

include_once  './connect_DB.php';

$errorMessageUsername = "";
$errorMessagePassword = "";

if ( isset($_POST['button-cancel']) ) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: ./PROJETOALMOFADAS/index.php");
}

if ( isset($_POST['button-login']) ) {
    
    $username = strtolower(trim(mysqli_real_escape_string($_conn,$_POST["formUsername"])));
    $username = trim($username);
    
    $password = trim(mysqli_real_escape_string($_conn,$_POST["formPassword"]));
    $password = trim($password);
    
    $username = strip_tags($username);
    
    $stmt = $_conn->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    
    $usersResult = $stmt->get_result();
    
    if ($usersResult->num_rows > 0) {
        while ($rowUsers = $usersResult->fetch_assoc()) {
            
            if ($rowUsers['USER_LEVEL']==2) { // BLocked user
                
                $errorMessagePassword="Não é possível entrar no sistema. Contacte os nossos serviços para obter ajuda.";
                
            } else  if ($rowUsers['USER_LEVEL']==0 ) { // User account created but not verified
                
                $errorMessagePassword=  $rowUsers['fNAME'] . ", ainda não ativou a sua conta. A mensagem com o código inicial de ativação de conta foi enviada para a sua caixa de correio. Caso não a encontre na sua caixa de entrada, verifique também o seu correio não solicitado ou envie-nos um email para ativarmos a sua conta. Obrigado.";
                
            } else  if ( password_verify($password, $rowUsers["PASSWORD"])) {
                
                $_SESSION["UTILIZADOR"]=$rowUsers["USERNAME"];
                $_SESSION["NIVEL_UTILIZADOR"]=$rowUsers["USER_LEVEL"];
                $_SESSION["NOME_UTILIZADOR"]= $rowUsers["NOME"];
                $_SESSION["EMAIL_UTILIZADOR"]= $rowUsers["EMAIL"];
                
                header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
                header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
                header("Location: index.php");
            } else {
                $errorMessagePassword = "password incorreta!";
            }
        }
    } else {
        $errorMessageUsername = "O código de utilizador não existe na nossa base de dados!";
    }
    
    $stmt->free_result();
    $stmt->close();
    
}
?>

<!DOCTYPE html>
<html>
<title>Cloud Gallery - Entrar</title>
<?php include_once  './includes/estilos.php'; ?>
<body>
<?php include_once  './includes/menus.php'; ?>

<!-- interface para entrar no sistema -->

<div class="w3-container w3-light-grey" style="padding:128px 16px" >
  <h3 class="w3-center">ENTRAR</h3>
  <p class="w3-center w3-large">Exclusivo para utilizadores registados.</p>
   
    
  <div style="margin-top:48px">
    <form action="#" method="POST">
      <p><input class="w3-input w3-border" type="text" style="width:300px" placeholder="Código de utilizador"  name="formUsername" value="<?php echo $username;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessageUsername;?></p>
 
      <p><input class="w3-input w3-border" type="password" placeholder="password"  name="formPassword" value="<?php echo $password;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessagePassword;?></p>
 
      <p>
        <button class="w3-button w3-black" name="button-login" type="submit"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">done</i> INICIAR SESSÃO</button>
        <button class="w3-button w3-black" name="button-cancel" type="submit"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">cancel</i> CANCELAR</button>
      </p>
    </form>
  </div>
  
   <br>
   <p>Esqueceu-se da password? <a href="userRecuperarpassword.php" class="w3-hover-text-green"> Recuperar password.</a></p>
  
</div>

<!--  -->
<?php include_once  './includes/rodape.php'; ?>
<?php include_once  './includes/scripts.php'; ?>
</body>
</html>


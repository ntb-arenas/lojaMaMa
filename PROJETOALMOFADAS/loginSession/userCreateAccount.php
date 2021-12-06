<?php 

session_start();

include_once  './connect_DB.php'; 
include_once './function_mail_utf8.php'; 


// iniciar e limpar possíveis mensagens de erro
$temporaryMsg = "";

$errorMessageUsername = "";
$errorMessageUsername = "";
$errorMessagePassword = "";
$errorMessagePasswordRecover = "";
$errorMessagefName = "";
$errorMessagelName = "";

// inciar e limpar variáveis
$username="";
$email="";
$password="";
$passwordConfirmation="";
$nome="";
$aceito="";
$aceitoMarketing = 0;

$geraFormulario = "Sim";


if ( isset($_POST['submit-cancelar-conta']) ) {
    
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // past date to encourage expiring immediately
    header("Location: index.php");
}


if ( isset($_POST['submit-criar-conta']) ) {


        $podeCriarRegisto = "Sim";
         
        // obter parametros (determinadas validações poderiam ser feitas no lado cliente)
        $username = mysqli_real_escape_string($_conn, $_POST['formUser']);
        $username = strtolower(trim($username));
        $email=mysqli_real_escape_string($_conn, $_POST['formEmail']);
        $email=strtolower(trim($email));
        $password=mysqli_real_escape_string($_conn, $_POST['formPassword1']);
        $password = trim($password);
        $passwordConfirmation=mysqli_real_escape_string($_conn, $_POST['formPassword2']);
        $passwordConfirmation = trim($passwordConfirmation);
        $nome= mysqli_real_escape_string($_conn, $_POST['formNome']);
        $nome = trim($nome);
        $aceito = $_POST['formAceito'];
       
        if ( $aceito == "aceito_marketing") { 
                   $aceitoMarketing = 1;
               } else {
                   $aceitoMarketing = 0;
        }
        
        // retirar possíveis tags html do código
        $username = strip_tags($username);
        $email = strip_tags($email);
        $nome = strip_tags($nome);
        
        // não permitir que um user tenha espaços no código...
        $username = str_replace(' ', '', $username);
        
        // validar parametros recebidos

        if (strlen(trim($username))<4) {
            $errorMessageUsername="O código é demasiado curto!";
            $podeCriarRegisto = "Nao"; 
        }

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessageUsername="O e-mail não é válido!";
            $podeCriarRegisto = "Nao"; 
        } 


        if (strlen(trim($password))<8) { 
            $errorMessagePassword="A password tem que ter pelo menos 8 caracteres!";
            $podeCriarRegisto = "Nao"; 
        }
        
        if ($password!=$passwordConfirmation) { 
            $errorMessagePasswordRecover="A password de confirmação deve ser igual à primeira password!";
            $podeCriarRegisto = "Nao"; 
        }

         
        if (strlen(trim($fName))<2) {
            $errorMessagefName="O nome é demasiado curto!";
            $podeCriarRegisto = "Nao"; 
        }

        if (strlen(trim($lName))<2) {
            $errorMessagelName="O nome é demasiado curto!";
            $podeCriarRegisto = "Nao"; 
        }
        
        // a check box não precisa de ser validada..
        
        // inicio
        
        if ( $podeCriarRegisto == "Sim") { 
            
            // validações corretas: validar se existe utilizador
            $stmt = $_conn->prepare('SELECT * FROM USERS WHERE username = ?');
            $stmt->bind_param('s', $username); 
            $stmt->execute();

            $resultadoUsers = $stmt->get_result();
    
            if ($resultadoUsers->num_rows > 0) {
                
                $errorMessageUsername = "Já existe um utilizador registado com este código.";
                
                $stmt->free_result();
                $stmt->close();
            }     
            
            else {
               
               
                ///////////////////////////////////
                // INSERE UTILIZADOR NA BASE DE DADOS
                //////////
                $sql= "INSERT INTO USERS (username, EMAIL, PASSWORD, NOME, NIVEL,USER_STATUS, MENSAGENS_MARKETING,DATA_HORA) 
                                    VALUES (?,?,?,?,?,?,?,?)";
                
                if ( $stmt = mysqli_prepare($_conn, $sql) ) {
                
                    $nivel = 1;
                    $status = 0;

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    
                    date_default_timezone_set('Europe/Lisbon');
                    $data_hora = date("Y-m-d H:i:s", time()); 
                                
                    mysqli_stmt_bind_param($stmt, "ssssiiis", $username, $email,$passwordHash,$nome,$nivel,$status,$aceitoMarketing,$data_hora);


                    mysqli_stmt_execute($stmt);

                    $geraFormulario = "Nao";
            
                } else{
            
                    echo "STATUS ADMIN (inserir user): " . mysqli_error($_conn);
                }
               
                mysqli_stmt_close($stmt);
                //////////
                // INSERIDO
                ////////////////////////////////////////
                
                ////////////////////////////////////////////////////////////////////////////
                // registo efetuado, gerar token, preparar e enviar mail de ativação
                $code = md5(uniqid(rand()));

                $sql= "UPDATE  USERS SET TOKEN_CODE=? WHERE username=?";
                
                if ( $stmt = mysqli_prepare($_conn, $sql) ) {
                                   
                    mysqli_stmt_bind_param($stmt, "ss", $code,$username);
                    mysqli_stmt_execute($stmt);
                
                    // Update efetuado com sucesso, preparar e enviar mensagem 
                    $id = base64_encode($username);
                    
                    $urlPagina = "http://localhost:8888/";
                    
                    // ou: $urlPagina = "http://alexandrebarao.infinityfreeapp.com/";
                    
                    $mensagem = "Caro(a) $nome" . "," . "\r\n" .  "\r\n" .

                        "Obrigado por se ter registado.". "\r\n" .  "\r\n" .

                        "Para ativar a sua conta basta carregar na seguinte ligação:" ."\r\n" ."\r\n" .

                        $urlPagina . "userAtivarConta.php?id=$id&code=$code" ."\r\n" ."\r\n" . 

                        "Esta mensagem foi-lhe enviada automaticamente.";  

                    $subject = "Ativação da sua conta em $urlPagina";

                    $mensagem = wordwrap($mensagem,70);

                    // send email
                    mail_utf8($email,$subject,$mensagem); 
                    //echo $mensagem; // apenas para efeitos de teste...
                    //$msgTemporaria = $email . " " . $subject . " " . $mensagem;
                    $msgTemporaria= $msgTemporaria . " " . "$nome, verifique por favor a sua caixa de correio para ativar de imediato a sua conta! Por vezes estas mensagens são consideradas correio não solicitado. Se não vir a mensagem de ativação verifique o seu correio não solicitado (SPAM).";
            
                    
                } else{
                    echo "STATUS ADMIN (gerar token): " . mysqli_error($_conn);
                }
               
                mysqli_stmt_close($stmt);
                    
                    
            } 
                
        }

        
        // fim
    
} 

?>



<!DOCTYPE html>
<html>
<title>Cloud Gallery - Criar conta</title>
<?php include_once  './includes/estilos.php'; ?>
<body>
<?php include_once  './includes/menus.php'; ?>

<!-- interface para entrar no sistema -->

<div class="w3-container w3-light-grey" style="padding:128px 16px" >
  <h3 class="w3-center">CRIAR CONTA</h3>
  
  <div style="margin-top:48px">
    <?php 
      if ($geraFormulario == "Sim") {  
    ?>
     <p class="w3-center w3-large">Exclusivo para novos utilizadores.</p>
    <form action="#" method="POST">
      <p><input class="w3-input w3-border" type="text" style="width:300px" placeholder="Código de utilizador"  name="formUser" value="<?php echo $username;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessageUsername;?></p>
 
      <p><input class="w3-input w3-border" type="email" placeholder="e-Mail"  name="formEmail" value="<?php echo $email;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessageUsername;?></p>
 
 
      <p><input class="w3-input w3-border" type="password" placeholder="password"  name="formPassword1" value="<?php echo $password;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessagePassword;?></p>

      <p><input class="w3-input w3-border" type="password" placeholder="Confirmação de password"  name="formPassword2" value="<?php echo $passwordConfirmation;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessagePasswordRecover;?></p>


      <p><input class="w3-input w3-border" type="text" placeholder="Nome completo"  name="formNome" value="<?php echo $nome;?>"></p>
      <p class="w3-large w3-text-red"><?php echo $errorMessagefName;?></p>
   
      <p><input class="w3-large w3-text-black" type="checkbox" name="formAceito" value="aceito_marketing" <?php if ($aceitoMarketing == 1 ) { echo " checked"; } ?>>
      <label> Aceito que os meus dados sejam utilizados para efeitos de marketing</label></p>
         
      <p>
        <button class="w3-button w3-black" name="submit-criar-conta" type="submit"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">done</i> CRIAR CONTA</button>
        <button class="w3-button w3-black" name=submit-cancelar-conta type="submit"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">cancel</i> CANCELAR</button>
        
      </p>
    </form>
  </div>
  
  <?php 
   } else { 
?>

  
   <p class="w3-center w3-large">Conta criada com sucesso</p>
    <p class="w3-center w3-large"><b><?php echo $msgTemporaria;?></b></p>

   <form action="./index.php" method="POST">
        <!-- A LINHA SEGUINTE DEVE SER REMOVIDA EM INSTANCIAÇÃO COM SERVIÇO DE EMAIL ATIVO -->
        <textarea class="w3-input w3-border" rows="10" cols="50"><?php echo $mensagem;?></textarea>
         
   		<p><button class="w3-button w3-black" type="submit">VOLTAR</button></p>
   
   </form>
   

<?php
   }   		
?>
  
  
  
  
</div>

<!--  -->
<?php include_once  './includes/rodape.php'; ?>
<?php include_once  './includes/scripts.php'; ?>
</body>
</html>






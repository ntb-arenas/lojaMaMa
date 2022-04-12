<?php
session_start();
include_once  './conexaobasedados.php';

// adicionar imagem 
$mensagemUpload="";

if ( isset($_POST['botao-upload']) ) {
    
    $pasta = "./uploadimagens/";
    
    $pastaPublicacao = trim($_SESSION["UTILIZADOR"]);
    
        
    $pasta = $pasta . $pastaPublicacao;
    mkdir($pasta, 0777, true);
    $pasta = $pasta . "/";

    
    // $target_dir = "./uploads/";
    $target_dir = $pasta;
    
    $nomeSemEspacos = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['fileToUpload']["name"]));
    
    
    $target_file = $target_dir . $nomeSemEspacos;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $mensagemUpload = $mensagemUpload . "O ficheiro é uma imagem - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $mensagemUpload = $mensagemUpload . "O ficheiro não é uma imagem.";
            $uploadOk = 0;
        }
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 15000000) {
        $mensagemUpload = $mensagemUpload . "A imagem é demasiado grande. Tamanho máximo = 12MB.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $mensagemUpload = $mensagemUpload . "Apenas são permitidos ficheiros JPG, JPEG, PNG e GIF.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $mensagemUpload = $mensagemUpload . "Desculpe, o ficheiro não foi carregado.";
            // if everything is ok, try to upload file
        } else {
            
            
            // Check if file already exists
            if (file_exists($target_file)) {
                // remover a imagem no servidor
                if(file_exists($target_file)) unlink($target_file);
                $mensagemUpload = $mensagemUpload . "A imagem anterior foi substituída."; // na realidade removida
                // $mensagemDivulgacao = $mensagemDivulgacao . "Sorry, file already exists.";
                // $uploadOk = 0;
            }
            
            
            
            
            
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $mensagemUpload = $mensagemUpload . "O ficheiro ". basename( $_FILES["fileToUpload"]["name"]). " foi carregado com sucesso.";
                
                // foi feito o upload
                            
                
            } else {
                $mensagemUpload = $mensagemUpload .  "Desculpe, verificou-se um erro no carregamento do ficheiro.";
            }
            
            // $mensagemUpload = $mensagemUpload . basename($_FILES["fileToUpload"]["name"]);
        }
        
}


// apagar apenas uma imagens de UPLOADS
if ( isset($_POST['botao-apagar-imagem']) ) {
    
    $target_file = $_POST["nomeDaImagem"];
    
    if (file_exists($target_file)) {
            // remover a imagem no servidor
            if(file_exists($target_file)) unlink($target_file);
           
    }
    
}

?>





<?php if (isset($_SESSION["UTILIZADOR"]) ) { ?>


<div class="w3-container" style="padding:128px 16px" id="noticias">
  <h3 class="w3-center">Notícias</h3>
  <p class="w3-center w3-large">(Exclusivo para utilizadores registados)</p>


      <table style="width:100%">
          <tr class="w3-black">
            <th>Título/Descrição</th>
            <th>Recurso Web</th>
          </tr>
   
          <?php 
           
            $resultadoTabelaNoticias = mysqli_query($_conn, "SELECT * FROM NOTICIAS");           
    
            if (mysqli_num_rows($resultadoTabelaNoticias) > 0) {
                $ctd = 0;
                while($rowTabelaNoticias = mysqli_fetch_assoc($resultadoTabelaNoticias)) {
                    $ctd=$ctd+1;
                ?>   
    
   
   
   
   	      <tr>
            <td><B><?php echo $rowTabelaNoticias["TITULO"]?></B><br><?php echo $rowTabelaNoticias["DESCRICAO"]?></td>
            <td>
            
            <?php if ( $rowTabelaNoticias["TIPO"] == 0 ) {  // link para website 
                ?><A HREF="<?php echo $rowTabelaNoticias["LIGACAO"];?>" target="_blank"><i class="material-icons" style="font-size:24px;vertical-align:middle;">link</i></A>
            <?php } ?>

            <?php if ( $rowTabelaNoticias["TIPO"] == 1 ) {  // Youtube 
                ?>
                
                <iframe  width="300" height="200" src="https://www.youtube.com/embed/<?php echo $rowTabelaNoticias["LIGACAO"];?>" frameborder="0" allowfullscreen></iframe>
                
            <?php } ?>
            
             <?php if ( $rowTabelaNoticias["TIPO"] == 3 ) {  // link para documento pdf 
                ?><A HREF="<?php echo $rowTabelaNoticias["LIGACAO"];?>" target="_blank"><i class="material-icons" style="font-size:24px;vertical-align:middle;">picture_as_pdf</i></A>
            <?php } ?>
           
            <?php if ( $rowTabelaNoticias["TIPO"] == 4 ) {  // link para imagem
                ?><IMG style="width:60%" SRC="<?php echo $rowTabelaNoticias["LIGACAO"];?>">
            <?php } ?>
            
            </td>
       			 
          </tr>
    
  	    <?php
                }
            }
            mysqli_free_result($resultadoTabelaNoticias);
           
        ?>
   

		</table>



</div>


<div class="w3-container" style="padding:128px 16px" id="minhasimagens">
  <h3 class="w3-center">Minhas imagens</h3>
  <p class="w3-center w3-large">(Exclusivo para utilizadores registados)</p>

  <form action="./index.php#minhasimagens" method="POST" enctype="multipart/form-data">
 
    <p class="w3-center w3-large"><i class="material-icons" style="font-size:24px;vertical-align:middle;">add_a_photo</i>  Carregar imagem. Certifique-se dos respetivos direitos de autor.</p>
  
    <input class="w3-input w3-border" type="file" name="fileToUpload" id="fileToUpload"/>
    <p class="w3-center w3-large"><b><?php echo $mensagemUpload;?></b></p>       
    <button class="w3-button w3-black"  name="botao-upload" type="submit"> <i class="material-icons" style="font-size:24px;vertical-align:middle;">send</i>  ENVIAR</button>
    </form>
 
  <div class="w3-row-padding w3-section" >
  
         <?php
            $dirname = "uploadimagens/" . trim($_SESSION["UTILIZADOR"] . "/");
            $images = glob($dirname."*.*");
            
            foreach($images as $image) { 
          
         ?>
                <div class="w3-col l3 m6" style="margin-top:24px">
                <img src="<?php echo $image;?>" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="<?php echo basename($image); ?>">
                <form action = "#minhasimagens" method = "POST">
                    <button class="w3-black" style="margin-top:12px" name="botao-apagar-imagem" type="submit"><i class="material-icons" style="font-size:24px;vertical-align:middle;">delete</i></button>
 
                   <input id="nomeDaImagem" name="nomeDaImagem" type="hidden" value="<?php echo $image; ?>">
                </form>    
                </div>
          <?php    
            }
          ?> 
      
  </div>
  
  
</div>





<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Fechar a imagem">×</span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<?php }  ?>

<?php
$mensagem .= '
<table width=100% border=0>
<tr>
    <td class="flex-out">
        <div style="display: block; text-align: center; margin: 0 auto">
            <a href="https://ntbarenas.000webhostapp.com/index.php" style="display: block; border: none"><img src="https://i.ibb.co/8751HZh/AMMHeader.png" alt="AMMHeader" border="0"></a>
        </div>
    </td>
<tr>
    <td colspan=2>
        <div style="
font-family: Arial, Helvetica, sans-serif;
color: #393838;
font-size: 12pt;
line-height: 18pt;
text-align: center;
margin-top: 20px;
">
            <center>
                <span style="color: #ec6408; font-size: 18.5pt"><strong>Obrigado por se ter registado! </strong></span>
            </center>
        </div>
    </td>
</tr>
<tr>
    <td colspan=2><br />
        <div style="
font-family: Arial, Helvetica, sans-serif;
color: #393838;
line-height: 14pt;
text-align: center;
margin-top: 10px;
">
            <center>
                <span style="font-size: 14.5pt"><strong>Para ativar a sua conta basta carregar na seguinte
                        ligação:
                    </strong></span>
            </center>
            <a style="font-size: 12pt; margin-top: 15px; background-color: #ff7b46; color: white; border-color: #ff7b46; padding: 10px;" href="' . $urlPagina . '/loginSession/userVerifyAccount.php?id=' . $id . '&code=' . $code . '">Clique aqui para ativar a sua conta</a>
            <center style=" margin-top: 10px;">
                <span style="font-size: 14.5pt;"><strong>Esta mensagem foi-lhe enviada automaticamente.</strong></span>
            </center>
        </div>
    </td>
</tr>
<tr>
    <td colspan=2>
        <div style="
font-family: Arial, Helvetica, sans-serif;
color: #333;
font-size: 8pt;
line-height: 10pt;
text-align: center;
font-weight: bold;
margin-top: 5rem;
">
            Centro Pré e Pós Parto - Rua José da Costa Pedreira No12, 1750-130
            Lisboa
            <div style="display: block">
                <img src="https://preview.wundermanlab.com/amm/20210706/spcr_13.png" alt="" class="spacer" />
            </div>
    </td>
</tr>
<td class="flex-out">
    <div style="display: block; text-align: center; margin: 0 auto">
        <a style="display: block; border: none"><img src="https://i.ibb.co/KWMLns0/footer.jpg" alt="" class="spacer logoFooter" /></a>
    </div>
</td>
</table>';


echo $mensagem;

?>
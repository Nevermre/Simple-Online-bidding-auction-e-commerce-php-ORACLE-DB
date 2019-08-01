<?php 
    session_start();
    include("conexao.php");
  $email = $_SESSION['email'];
    include('topo.php');

    

?>



<div class="container text-center">    
  <h3>Anunciar leilão</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Anuncie um produto</h5>
        <p class="card-text">Anuncie um produto que você gostaria de leiloar.</p>
        <a href="anunciarL.php" class="btn btn-primary">Anunciar agora</a>
    </div>
    </div>
</div>
<br><br>

<div class="container text-center">    
  <h3>Leilões ativos</h3><br>

  </div>
<br><br>


<?php 
/* ISSO AQUI ALTERA O STATUS SE EXPIROU
  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  value(t),s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s, table(s.dono.FONES) t where s.status=0";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);

  $dt = new DateTime(gmdate('Y-m-d H:i:s'), new DateTimeZone("America/Campo_Grande"));
    $dt->modify("-3 hours");
    $dt2 = $dt->format("Y-m-d H:i:s");
    //echo $dt2;
    $dt->modify("+30 minutes");
    $dt3 =  $dt->format("Y-m-d H:i:s");

  while($rowservico = oci_fetch_array($resultadoservico)  ){ 
    $idd= $rowservico[7];
    if($rowservico[5]<$dt2){

        $sqlstatus = "UPDATE SYS.itemleilao s set s.status=1 where s.id='$idd'";
        $altera=oci_parse($conexao,$sqlstatus);
        oci_execute($altera);

    }

  }
  */
  

?>



  
  
  
  


<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  s.dono.email,s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s  where s.status=0";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php while($rowservico = oci_fetch_array($resultadoservico)  ){ 


$sqlreports = "select count(z.idreport) from SYS.itemleilao u, table(u.reports)z where u.id='$rowservico[7]'";
$resultreports = oci_parse($conexao,$sqlreports);
oci_execute($resultreports);
$rowreports = oci_fetch_array($resultreports);

if($rowreports[0]>=5){

  $sqlsetstatus="update SYS.itemleilao u set u.status=2 where u.id='$rowservico[7]'";
  $resultsetstatus = oci_parse($conexao,$sqlsetstatus);
  oci_execute($resultsetstatus);

}  
  else{ 
  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  <div class="card-header">
    <?= $rowservico[2] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $rowservico[8] ?></h5>
    <p class="card-text"><?= $rowservico[0] ?></p>
    <p class="card-text"><?= "Telefones:<br>" ?>
    
        <?php
        
            $sqltelefone="select value(t) from SYS.usuario u,table(u.fones) t where u.email='$rowservico[3]'";
            $resulttelelefone=oci_parse($conexao,$sqltelefone);
            oci_execute($resulttelelefone);
            while($rowtel=oci_fetch_array($resulttelelefone)){ 
            echo $rowtel[0];
            echo "<br>";
            }
        ?>
    
    </p>
    <p class="card-text"><?= "Contato: ".$rowservico[1] ?></p>
    
    <p class="card-text"><?= "Valor Mínimo: ".$rowservico[4] ?></p>
    
    <p class="card-text" style="font-size:0.8em;"><?= "Data da publicação: ".$rowservico[6] ?></p>
    
    <p class="card-text" style="font-size:0.8em;"><?= "Valido até: ".$rowservico[5] ?></p>

    <form action="reportar.php" class="text-center" style="color: #757575;" method="post">

      <input type="hidden" name="idvenda" value=<?=$rowservico[7]?>>
      <input type="hidden" name="idusuario" value=<?=$_SESSION['email']?>>
      <input type="hidden" name ="tab" value = "leilao">
      <?php
      
      $sqlverifica = "SELECT count(r.idreport.email) from SYS.itemleilao s, table(s.reports)r where s.id='$rowservico[7]' and r.idreport.email='$email'";
      $resultverifica = oci_parse($conexao,$sqlverifica);
      oci_execute($resultverifica);
      $verifica = oci_fetch_array($resultverifica);
      if($rowservico[3]!=$_SESSION['email']){

      ?>

      <input type="submit" class="btn btn-danger" value=<?php
      
            if($verifica[0]==0)
              echo "Reportar";
            else 
              echo "Reportado";
      
      
      ?>> <?php } ?>

      </form>
      <br>
    
    <form action="participarL.php" class="text-center" style="color: #757575;" method="post">

        <input type="hidden" name="id" value=<?=$rowservico[7]?>>
    <input type="submit" class="btn btn-primary" value="Participar do Leilão">

    </form>
   
    
  </div>
</div>
<?php }} ?>



<br><br><br>

<div class="container text-center">    
  <h3>Histórico de leilões</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Leiloes realizados</h5>
        <p class="card-text">Veja os leilões realizados e seus ganhadores.</p>
      
    </div>
    </div>
</div>
<br><br>


<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  value(t),s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s, table(s.dono.FONES) t where s.status=1";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php

while($rowservico = oci_fetch_array($resultadoservico)  ){ 

    $id=$rowservico[7];

  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  <div class="card-header">
    <?= $rowservico[2] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $rowservico[8] ?></h5>
    <p class="card-text"><?= $rowservico[0] ?></p>
    <p class="card-text"><?= "Telefone:".$rowservico[3] ?></p>
    <p class="card-text"><?= "Contato: ".$rowservico[1] ?></p>
    
    <p class="card-text"><?= "Valor Mínimo: ".$rowservico[4] ?></p>
    
    <p class="card-text" style="font-size:0.8em;"><?= "Data da publicação: ".$rowservico[6] ?></p>
    
    <p class="card-text" style="font-size:0.8em;"><?= "Valido até: ".$rowservico[5] ?></p>
    
    <form action="participarL.php" class="text-center" style="color: #757575;" method="post">

        <input type="hidden" name="id" value=<?=$rowservico[7]?>>
   
    </form>

    <h5 class="card-header info-color white-text text-center py-4 ">
        <strong>Andamento do leilão</strong>
        </h5>


        <?php

            $sqllances = "SELECT l.comprador.nome,l.valorlance,l.datal FROM SYS.lance l WHERE l.itemleilao.id='$id' order by l.valorlance DESC";
            $resultadolance = oci_parse($conexao,$sqllances);
            oci_execute($resultadolance);
            $i=0;

            while($rowlances = oci_fetch_array($resultadolance)){

                if($i==0)
                  echo "VENCEDOR: ".$rowlances[0]."<br>Valor do lance: ".$rowlances[1]."<br>Data: ".$rowlances[2]."<br><br>";
                else
                    echo "Usuário: ".$rowlances[0]."<br>Valor do lance: ".$rowlances[1]."<br>Data: ".$rowlances[2]."<br><br>";

                $i++;

            }


        ?>
   
    
  </div>
</div>
<?php } ?>





</body>
</html>
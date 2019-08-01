<?php 
    session_start();
    $email=$_SESSION['email'];
    include("conexao.php");

    

      include('topo.php');

?>




<div class = "container">

</div>

  
<div class="container text-center">    
  <h3>Vender produto</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Anuncie um produto</h5>
        <p class="card-text">Anuncie um produto que você gostaria de vender, trocar ou doar.</p>
        <a href="anunciarP.php" class="btn btn-primary">Anunciar agora</a>
    </div>
    </div>
</div>
<br><br>


<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat, s.preco, s.dono.email,s.operacao,s.id,s.titulo from SYS.venda s where s.status=0";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php while($rowservico = oci_fetch_array($resultadoservico)  ){ 


$sqlreports = "select count(z.idreport) from SYS.venda u, table(u.reports)z where u.id='$rowservico[6]'";
$resultreports = oci_parse($conexao,$sqlreports);
oci_execute($resultreports);
$rowreports = oci_fetch_array($resultreports);

if($rowreports[0]>=5){

  $sqlsetstatus="update SYS.venda u set u.status=2 where u.id='$rowservico[6]'";
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
    <h5 class="card-title"><?= $rowservico[5] ?></h5>
    <h5 class="card-title"><?= $rowservico[7] ?></h5>
    <p class="card-text"><?= $rowservico[0] ?></p>
    <p class="card-text"><?= "Telefones:<br>" ?>
    
        <?php
        
            $sqltelefone="select value(t) from SYS.usuario u,table(u.fones) t where u.email='$rowservico[4]'";
            $resulttelelefone=oci_parse($conexao,$sqltelefone);
            oci_execute($resulttelelefone);
            while($rowtel=oci_fetch_array($resulttelelefone)){ 
            echo $rowtel[0];
            echo "<br>";
            }
        ?>
    
    </p>
    <p class="card-text"><?= "Contato: ".$rowservico[1] ?></p>
   
<p class="card-text"><?php if($rowservico[5]=="venda"){ ?><?= "Preço: ".$rowservico[3]." R$" ?><?php }?> </p>

<form action="reportar.php" class="text-center" style="color: #757575;" method="post">

      <input type="hidden" name="idvenda" value=<?=$rowservico[6]?>>
      <input type="hidden" name="idusuario" value=<?=$_SESSION['email']?>>
      <input type="hidden" name ="tab" value = "venda">
      <?php
      
      $sqlverifica = "SELECT count(r.idreport.email) from SYS.venda s, table(s.reports)r where s.id='$rowservico[6]' and r.idreport.email='$email'";
      $resultverifica = oci_parse($conexao,$sqlverifica);
      oci_execute($resultverifica);
      $verifica = oci_fetch_array($resultverifica);
      if($rowservico[4]!=$_SESSION['email']){ 

      ?>

      <input type="submit" class="btn btn-danger" value=<?php
      
            if($verifica[0]==0)
              echo "Reportar";
            else 
              echo "Reportado";
      
      
      ?>> <?php } ?>

      </form>
    
  </div>
</div>
<?php }} ?>





</body>

</html>
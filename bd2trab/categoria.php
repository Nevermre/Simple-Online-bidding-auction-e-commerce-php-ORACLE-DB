<?php 
    session_start();
    include("conexao.php");
    $email = $_SESSION['email'];
    include('topo.php');

?>



<div class="container text-center">    
  <h2>Anuncios por categoria</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Veja os anuncios abertos por categoria</h5>
        
    </div>
    </div>
</div>
<br><br>

<?php

    $sqlcat = "Select c.cat from SYS.categoria c";
    $resultcat = oci_parse($conexao,$sqlcat);
    oci_execute($resultcat);

    while($rowcat=oci_fetch_array($resultcat)){ 
        $cat=$rowcat[0];

?>




<div class="container text-center">    
  <h3><?= "CATEGORIA: ".$cat?></h3><br>

</div>
<br><br>

<div class="container text-center">    
  <h5>Serviços</h3><br>

</div>
<br><br>

<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat, s.preco,s.titulo,s.dono.email from SYS.servico s where s.status=0 and s.categ.cat='$cat' order by s.preco asc";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php while($rowservico = oci_fetch_array($resultadoservico)  ){ 
  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  
  <div class="card-body">
    <p class="card-text"><?= $rowservico[0] ?></p>
    <p class="card-text"><?= "Telefones:<br>" ?>
    
        <?php
        
            $sqltelefone="select value(t) from SYS.usuario u,table(u.fones) t where u.email='$rowservico[5]'";
            $resulttelelefone=oci_parse($conexao,$sqltelefone);
            oci_execute($resulttelelefone);
            while($rowtel=oci_fetch_array($resulttelelefone)){ 
            echo $rowtel[0];
            echo "<br>";
            }
        ?>
    
    </p>
    <p class="card-text"><?= "Contato: ".$rowservico[1] ?></p>
    <p class="card-text"><?= "Preço: ".$rowservico[3]." R$/hr" ?></p>
    
  </div>
</div>
<?php } ?>



<div class="container text-center">    
  <h5>Vendas</h3><br>

</div>
<br><br>



<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat, s.preco, s.dono.email,s.operacao from SYS.venda s where s.status=0 and s.categ.cat='$cat' order by s.preco desc";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php while($rowservico = oci_fetch_array($resultadoservico)  ){ 
  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  
  <div class="card-body">
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
    
  </div>
</div>
<?php } ?>


<div class="container text-center">    
  <h5>Leilões</h3><br>

</div>
<br><br>



<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  s.dono.email,s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s where s.status=0 and s.categ.cat='$cat' order by s.valormin asc";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  

?>

<div class="container">


<?php while($rowservico = oci_fetch_array($resultadoservico)  ){ 
  
  
  
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
    
    <form action="participarL.php" class="text-center" style="color: #757575;" method="post">

        <input type="hidden" name="id" value=<?=$rowservico[7]?>>
    <input type="submit" class="btn btn-primary" value="Participar do Leilão">

    </form>
   
    
  </div>
</div>
<?php } ?>




    <?php } ?>


</body>
</html>
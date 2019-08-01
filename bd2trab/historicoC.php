<?php 
    session_start();
    include("conexao.php");
    $email = $_SESSION['email'];
    include('topo.php');

?>


<?php 

  $sqlcomprasativas = "SELECT s.descricao, s.categ.cat, s.preco, s.operacao,s.id from SYS.venda s where s.status=0 and s.dono.email='$email'";
  $resultadocomprasativas = oci_parse($conexao,$sqlcomprasativas);
  oci_execute($resultadocomprasativas);
  

?>


<div class="container text-center">    
  <h3>Fechar vendas</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Feche as vendas,trocas ou doações realizadas</h5>
        
    </div>
    </div>
</div>
<br><br>


<div class="container">


<?php while($rowcomprasativas = oci_fetch_array($resultadocomprasativas)  ){ 
  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  <div class="card-header">
    <?= $rowcomprasativas[1] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $rowcomprasativas[3] ?></h5>
    <p class="card-text"><?= $rowcomprasativas[0] ?></p>
   
<p class="card-text"><?php if($rowcomprasativas[3]=="venda"){ ?><?= "Preço: ".$rowcomprasativas[2]." R$" ?><?php }?> </p>
    
    <form action ="fecharC.php" class="text-center" style="color: #757575;" method="post">


    <div class="md-form mt-3">
    <label for="materialSubscriptionFormPasswords">Insira o valor ou objeto fechado</label>
    <input type="text" name="valorfechado" class="form-control" >
    <input type="hidden" name="id" class="form-control" value = <?= $rowcomprasativas[4] ?> >
        
    </div>

    <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Fechar venda</button>

    </form>


  </div>
</div>
<?php } ?>





<?php 

  $sqlcomprasrealizadas = "SELECT s.idvenda.descricao, s.idvenda.categ.cat, s.idvenda.preco, s.idvenda.operacao,s.idvenda.id, s.valor_da_venda from SYS.venda_simples s where s.idvenda.dono.email='$email' ";
  $resultadocomprasrealizadas = oci_parse($conexao,$sqlcomprasrealizadas);
  oci_execute($resultadocomprasrealizadas);
  

?>

<div class="container text-center">    
  <h3>Vendas Fechadas</h3><br>

  <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem;">
    
    <div class="card-body">
        <h5 class="card-title">Vendas realizadas por você</h5>
        
    </div>
    </div>
</div>
<br><br>


<div class="container">


<?php while($rowcomprasativas = oci_fetch_array($resultadocomprasrealizadas)  ){ 
  
  
  
  ?>

<div class="d-inline-block card" style="width: 18rem; min-height:15rem; margin-bottom:5%;">
  <div class="card-header">
    <?= $rowcomprasativas[1] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $rowcomprasativas[3] ?></h5>
    <p class="card-text"><?= $rowcomprasativas[0] ?></p>
   
<p class="card-text"><?php if($rowcomprasativas[3]=="venda"){ ?><?= "Preço: ".$rowcomprasativas[2]." R$" ?><?php }?> </p>

   <p class="card-text"><?php if($rowcomprasativas[3]=="venda"){ ?><?= "Vendido por: ".$rowcomprasativas[5]." R$" ?><?php }?> </p>
   <p class="card-text"><?php if($rowcomprasativas[3]=="troca"){ ?><?= "Trocado por: ".$rowcomprasativas[5] ?><?php }?> </p>
  
    


  </div>
</div>
<?php } ?>





</body>
</html>
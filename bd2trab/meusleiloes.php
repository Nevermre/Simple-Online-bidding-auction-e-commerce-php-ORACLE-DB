<?php 
    session_start();
    include("conexao.php");
    $email = $_SESSION['email'];
    include('topo.php');

?>


<div class=" container ">

<?php 

  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  s.dono.email,s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s, table(s.dono.FONES) t where s.status=0 and s.dono.email='$email'";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);

  while($row=oci_fetch_array($resultadoservico)){ 
      $id=$row[7];
  

?>


<div class="row justify-content-center ">
<div class=" card col-lg-4 col-lg-offset-4 mt-4">

    <h5 class="card-header info-color white-text text-center py-4 ">
        <strong>Leilao: <?=$row[8]?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">

        <!-- Form -->
        <form action ="martelo.php" class="text-center" style="color: #757575;" method="post">
            <input type="hidden" name="idusuario" value=<?=$email?>>

             <input type="hidden" name="iditemvenda" value=<?=$row[7]?>>
            

            

            
            
            
            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Categoria</strong></label>
                 <p><?=$row[2]?></p>
            </div>
            

            <!-- Name -->
            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Descrição</strong></label>
                 <p><?=$row[0]?></p>
            </div>
            

            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Data da publicação</strong></label>
                 <p><?=$row[6]?></p>
            </div>
           

            
            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Data de abate</strong></label>
                 <p><?=$row[5]?></p>
            </div>
            

            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Valor Minimo</strong></label>
                 <p><?=$row[4]?></p>
            </div>
            
            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Bater o martelo</button>
        </form>

        <form action ="prorrogar.php" class="text-center" style="color: #757575;" method="post">

        <input type="hidden" name="idusuario" value=<?=$email?>>

<input type="hidden" name="iditemvenda" value=<?=$row[7]?>>

          <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">prorrogar o leilao</button>
       
        
        </form>

        


        </div>

        <h5 class="card-header info-color white-text text-center py-4 ">
        <strong>Andamento do leilão</strong>
        </h5>


        <?php

            $sqllances = "SELECT l.comprador.nome,l.valorlance,l.datal FROM SYS.lance l WHERE l.itemleilao.id='$id' order by l.valorlance DESC";
            $resultadolance = oci_parse($conexao,$sqllances);
            oci_execute($resultadolance);

            while($rowlances = oci_fetch_array($resultadolance)){
                    echo "Usuário: ".$rowlances[0]."<br>Valor do lance: ".$rowlances[1]."<br>Data: ".$rowlances[2]."<br><br>";



            }


        ?>

</div>
</div>

        <?php } ?>
        </div>
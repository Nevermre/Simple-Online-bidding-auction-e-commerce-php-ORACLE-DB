<?php 
    session_start();
    include("conexao.php");
    $id=$_POST['id'];
    $email=$_SESSION['email'];

    include('topo.php');


    $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  s.dono.email,s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO,s.dono.email from SYS.itemleilao s where s.id='$id'";
    $resultadoservico = oci_parse($conexao,$sqlservico);
    oci_execute($resultadoservico);
    $row=oci_fetch_array($resultadoservico);



    $sqlmaior = "SELECT l.comprador.nome,l.valorlance,l.datal FROM SYS.lance l WHERE l.itemleilao.id='$id' order by l.valorlance DESC";
            $resultadolancemaior = oci_parse($conexao,$sqlmaior);
            oci_execute($resultadolancemaior);
        $rowmaior=oci_fetch_array($resultadolancemaior);

    if(isset($rowmaior[1]))
        $maior=$rowmaior[1];

?>



<div class="container ">
<div class="row justify-content-center ">
<div class="card col-lg-4 col-lg-offset-4 mt-4">

    <h5 class="card-header info-color white-text text-center py-4 ">
        <strong>Participar do leilao: <?=$row[8]?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">

        <!-- Form -->
        <form action ="darlance.php" class="text-center" style="color: #757575;" method="post">
            <input type="hidden" name="idusuario" value=<?=$email?>>

             <input type="hidden" name="iditemvenda" value=<?=$row[7]?>>
            

            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Dono do Leilão</strong></label>
                 <p><?=$row[1]?></p>
            </div>
            <br>


           
            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords"><strong>Telefones:</strong></label>
            <p class="card-text">
    
    <?php
    
        $sqltelefone="select value(t) from SYS.usuario u,table(u.fones) t where u.email='$row[3]'";
        $resulttelelefone=oci_parse($conexao,$sqltelefone);
        oci_execute($resulttelelefone);
        while($rowtel=oci_fetch_array($resulttelelefone)){ 
        echo $rowtel[0];
        echo "<br>";
        }
    ?>

</p>
            </div>
            
            
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
            

            <!-- E-mai --> <?php if($email!=$row[3]){ ?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Lance: R$</span>
                </div>
                <input type="number" min=<?php if(isset($maior))echo $maior+1; else echo$row[4];?> name = "preco" class="form-control" placeholder="Preço" aria-label="preco" aria-describedby="basic-addon1">
            </div>

            



            <!-- Sign in button -->
           
            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Dar Lance</button><?php } ?>

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
</div>






</body>
</html>
<?php 
    session_start();
    include("conexao.php");

    include('topo.php');

?>




<div class="container ">
<div class="row justify-content-center ">
<div class="card col-lg-4 col-lg-offset-4 mt-4">

    <h5 class="card-header info-color white-text text-center py-4 ">
        <strong>Anunciar produto para leilão</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">

        <!-- Form -->
        <form action ="anuncioL.php" class="text-center" style="color: #757575;" method="post">

            <p>Forneça algumas informações sobre o seu produto.</p>

            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords">Titulo</label>
            <input type="text" name="titulo" class="form-control" >
                
            </div>
            

            <!-- Name -->
            <div class="md-form mt-3">
            <label for="materialSubscriptionFormPasswords">Descrição</label>
                <textarea type="text" name="desc" rows="3" class="form-control"></textarea>
                
            </div>
            <br>

            <!-- E-mai -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">R$</span>
                </div>
                <input type="text" name = "preco" class="form-control" placeholder="Valor Inicial" aria-label="preco" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
                </div>
                <select class="custom-select" name="categ">
                    <?php $sql="SELECT * FROM SYS.categoria";
                        $result = oci_parse($conexao,$sql);
                        oci_execute($result);
                        while($row = oci_fetch_array($result)){ ?>
                    
                    <option value=<?= $row[0]?>><?= $row[0]?></option>
                        <?php }?>

                </select>
            </div>

            



            <!-- Sign in button -->
            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Anunciar</button>

        </form>
        <!-- Form -->

    </div>

</div>
</div>
</div>

  





</body>

</html>
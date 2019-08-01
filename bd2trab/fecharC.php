<?php 
    session_start();
    include("conexao.php");


    $id=$_POST['id'];
    $valorfechado=$_POST['valorfechado'];
    echo $id.$valorfechado;
    $sqlupdate = "update SYS.venda a set a.status = 1 where a.id='$id' ";
    $resultadoupdate = oci_parse($conexao,$sqlupdate);
    oci_execute($resultadoupdate);


    $sqlvendasimples = "insert into SYS.venda_simples v values ((SELECT REF(a) FROM SYS.VENDA a WHERE a.id='$id'),'$valorfechado' ) ";
    $resultvenda = oci_parse($conexao,$sqlvendasimples);
    oci_execute($resultvenda);

    header('location: historicoC.php');
    

?>
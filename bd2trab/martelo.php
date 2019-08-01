<?php 
    session_start();
    echo "logou";
    echo $_SESSION['email'];
    include("conexao.php");
    $email = $_SESSION['email'];
    $id = $_POST['iditemvenda'];
    echo '<br>';
    include('topo.php');

    $sql = "update SYS.itemleilao i set status=1 where i.id='$id'";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);
    header('location: leilao.php');

?>
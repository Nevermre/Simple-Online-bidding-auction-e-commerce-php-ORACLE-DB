<?php

session_start();
include("conexao.php");
//echo $id;
$email=$_SESSION['email'];
$iditem = $_POST['iditemvenda'];
$preco = $_POST['preco'];



$sql = "insert into SYS.lance(VALORLANCE,DATAL,COMPRADOR,ITEMLEILAO)  values('$preco',sysdate,(SELECT REF(t) FROM SYS.USUARIO t where t.email='$email'),(SELECT REF(i) FROM SYS.ITEMLEILAO i where i.id='$iditem')) ";

$result=oci_parse($conexao,$sql);
oci_execute($result);



header('location: leilao.php');

?>
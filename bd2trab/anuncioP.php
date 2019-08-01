<?php

include('conexao.php');
session_start();
$email=$_SESSION['email'];
$titulo=$_POST['titulo'];
$descricao=$_POST['desc'];
$preco=$_POST['preco'];
$operacao=$_POST['op'];
$categoria=$_POST['categ'];

$sql = "INSERT INTO SYS.venda(ID,STATUS,DESCRICAO,DONO,CATEG,PRECO,OPERACAO,dataPublicacao,titulo) VALUES (SYS.anuncioid.nextval,0,'$descricao',(SELECT REF(t) FROM SYS.usuario t WHERE t.email='$email'),(SELECT REF(y) FROM SYS.categoria y where y.cat='$categoria'),'$preco','$operacao',sysdate,'$titulo')";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);

    header('location: compras.php');









?>
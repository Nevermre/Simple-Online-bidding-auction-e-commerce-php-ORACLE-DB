<?php

include('conexao.php');
session_start();
$email=$_SESSION['email'];
$titulo=$_POST['titulo'];
$descricao=$_POST['desc'];
$valorinicial=$_POST['preco'];
$categoria=$_POST['categ'];

$sql = "INSERT INTO SYS.itemleilao(ID,STATUS,DESCRICAO,DONO,CATEG,VALORMIN,TITULO,dataPublicacao,datamax) VALUES (SYS.anuncioid.nextval,0,'$descricao',(SELECT REF(t) FROM SYS.usuario t WHERE t.email='$email'),(SELECT REF(y) FROM SYS.categoria y where y.cat='$categoria'),'$valorinicial','$titulo',sysdate,sysdate + (10/1440))";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);



    $sql = "
    update SYS.itemleilao s set s.reports = (tlistreport(treport(s.dono)))";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);

    

    header('location: leilao.php');









?>
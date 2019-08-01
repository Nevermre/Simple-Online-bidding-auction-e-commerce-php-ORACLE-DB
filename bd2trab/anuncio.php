<?php

    session_start();
    include("conexao.php");
    $email = $_SESSION['email'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['desc'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categ'];

    echo $titulo." ". " " . $descricao. " ". $preco . " " . $categoria;

    $sql = "INSERT INTO SYS.servico(ID,STATUS,DESCRICAO,DONO,CATEG,PRECO,TITULO,dataPublicacao) VALUES (SYS.anuncioid.nextval,0,'$descricao',(SELECT REF(t) FROM SYS.usuario t WHERE t.email='$email'),(SELECT REF(y) FROM SYS.categoria y where y.cat='$categoria'),'$preco','$titulo',sysdate )";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);

    header('location: inicio.php');

    



?>
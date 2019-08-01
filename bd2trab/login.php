<?php
    include("conexao.php");
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    echo $email;
    echo $senha;

    $sql = "SELECT u.email,u.nome FROM SYS.usuario u where u.email='$email' and u.senha='$senha'";
    $result = oci_parse($conexao,$sql);
    oci_execute($result);
    
    $row = oci_fetch_array($result);
    echo $row[0];
    if($row[0]==$email){
        echo "entrou";
        session_start();
        $_SESSION['email']=$email;
        $_SESSION['nome'] = explode(" ",$row[1])[0];
        header('location: inicio.php');

    }

    else{ 
        echo "n foi";
        header('location: index.php');
    }
     



 ?>
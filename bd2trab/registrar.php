<?php
    include("conexao.php");
    $nome=$_POST['nome'];
    $senha = $_POST['password'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $telefone2 = isset($_POST['telefone2'])?$_POST['telefone2']:'';
    $telefone3 =isset($_POST['telefone3'])?$_POST['telefone3']:'';
    $telefone4 = isset($_POST['telefone4'])?$_POST['telefone4']:'';
    $telefone5=isset($_POST['telefone5'])?$_POST['telefone5']:'';

    echo $nome . " " . $senha . " " . $email . " " . $telefone;


    $sql= "INSERT INTO SYS.USUARIO (NOME,EMAIL,SENHA,FONES) VALUES ('$nome','$email','$senha',SYS.tlistfone('$telefone','$telefone2','$telefone3','$telefone4','$telefone5')) ";
    echo $sql;
    $result = oci_parse($conexao,$sql);
    var_dump($result);
    oci_execute($result);

    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = explode(" ",$nome)[0];
    header('location: inicio.php');




?>
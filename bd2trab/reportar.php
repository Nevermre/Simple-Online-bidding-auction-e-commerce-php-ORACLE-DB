<?php

include("conexao.php");
$id =  $_POST['idvenda'];

echo $_POST['idusuario'];
$email = $_POST['idusuario'];
$tab = $_POST['tab'];
echo $tab;

if($tab == "servico"){ 
        $sqlverifica = "SELECT count(r.idreport.email) from SYS.servico s, table(s.reports)r where s.id='$id' and r.idreport.email='$email'";
        $resultverifica = oci_parse($conexao,$sqlverifica);
        oci_execute($resultverifica);
        $verifica = oci_fetch_array($resultverifica);

        if($verifica[0]==0){ 
        $sql = "INSERT INTO TABLE (SELECT s.REPORTS from SYS.SERVICO s WHERE s.id='$id') VALUE (SELECT REF(u) from SYS.usuario u where u.email='$email')";
        $result = oci_parse($conexao,$sql);
        oci_execute($result);
        }
        else
            echo "você já reportou";
        echo $verifica[0];

        header('location: inicio.php');
}

else {

    if($tab == "venda"){ 
        $sqlverifica = "SELECT count(r.idreport.email) from SYS.venda s, table(s.reports)r where s.id='$id' and r.idreport.email='$email'";
        $resultverifica = oci_parse($conexao,$sqlverifica);
        oci_execute($resultverifica);
        $verifica = oci_fetch_array($resultverifica);

        if($verifica[0]==0){ 
        $sql = "INSERT INTO TABLE (SELECT s.REPORTS from SYS.venda s WHERE s.id='$id') VALUE (SELECT REF(u) from SYS.usuario u where u.email='$email')";
        $result = oci_parse($conexao,$sql);
        oci_execute($result);
        }
        else
            echo "você já reportou";
        echo $verifica[0];
        header('location: compras.php');
}

    else{

        $sqlverifica = "SELECT count(r.idreport.email) from SYS.itemleilao s, table(s.reports)r where s.id='$id' and r.idreport.email='$email'";
        $resultverifica = oci_parse($conexao,$sqlverifica);
        oci_execute($resultverifica);
        $verifica = oci_fetch_array($resultverifica);

        if($verifica[0]==0){ 
        $sql = "INSERT INTO TABLE (SELECT s.REPORTS from SYS.itemleilao s WHERE s.id='$id') VALUE (SELECT REF(u) from SYS.usuario u where u.email='$email')";
        $result = oci_parse($conexao,$sql);
        oci_execute($result);
        }
        else
            echo "você já reportou";
        echo $verifica[0];
        header('location: leilao.php');



    }

}

//header('location: inicio.php');
?>
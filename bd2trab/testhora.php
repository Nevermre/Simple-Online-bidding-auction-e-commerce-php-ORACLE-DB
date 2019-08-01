<?php 
include('conexao.php');
//echo gmdate('Y-m-d H:i:s')."<br>";
$dt = new DateTime(gmdate('Y-m-d H:i:s'), new DateTimeZone("America/Campo_Grande"));
$dt->modify("-3 hours");
$dt2 = $dt->format("Y-m-d H:i:s");
//echo $dt2;
$dt->modify("+30 minutes");
$dt3 =  $dt->format("Y-m-d H:i:s");
//echo $dt3;





  $sqlservico = "SELECT s.descricao, s.dono.nome, s.categ.cat,  value(t),s.VALORMIN,to_char(DATAMAX, 'yyyy-mm-dd hh24:mi:ss'),to_char(DATAPUBLICACAO, 'yyyy-mm-dd hh24:mi:ss'),ID,TITULO from SYS.itemleilao s, table(s.dono.FONES) t where s.status=0";
  $resultadoservico = oci_parse($conexao,$sqlservico);
  oci_execute($resultadoservico);
  




echo"<br>";
 while($rowservico = oci_fetch_array($resultadoservico)  ){ 
  
    echo $rowservico[5]." ".$dt2;
    if($rowservico[5]<$dt2)
        echo "Expirou"."<br>";
    else 
        echo "Não Expirou"."<br>";
  
 }

?>
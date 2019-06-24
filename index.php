<?php 


require_once("config.php");

$sql = new Sql();


$usuarios = $sql->select("SELECT * FROM tb_usuarios");


//echo json_encode($usuarios);

$json = json_encode($usuarios);

$valor = json_decode($json, true);
var_dump($valor);

 ?>
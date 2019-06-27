<?php 


require_once("config.php");



//carrega 1 usuario
$usuario = new Usuario();
$usuario->loadById(2);
echo $usuario;

echo "<br><br>";

// carrega uma lista
//carregar metodo statico
$lista = Usuario::getList();
echo json_encode($lista);

echo "<br><br>";

// carraga uma lista buscando pelo login
$busca = Usuario::search("i");
echo json_encode($busca);


echo "<br><br>";


//carrega um usuario validando
$login = new Usuario();
$login->login('leo','456');
echo $login;

 ?>
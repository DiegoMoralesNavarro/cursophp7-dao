<?php 



class Sql extends PDO{

	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:dbname=dbphp7; host=localhost", "root", "");
	}


	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			$this->setParam($key, $value);
			//$statment->bindParam($key, $value);
		}

	}


	private function setParam($statment, $hey, $value){

		$statment->bindParam($key, $value);

	}


	/*
	No query(), podemos executar os comandos insert, update 
	e delete, e não se espera o retorno de qualquer informação
	*/
	public function query($rawQuery, $params = array()){

		//comando slq e valores
		$stmt = $this->conn->prepare($rawQuery);

		// gerando o baind para passar os valores
		$this->setParams($stmt, $params);

		//executando
		$stmt->execute();

		// retornar a função toda
		return $stmt;
	}




	/*
	Já no método 
	select(), executaremos uma instrução select, aguardando o retorno solicitado.

	 $raw-Query, no qual será inserido o código SQL 
	*/
	public function select($rawQuery, $params = array()):array {

		//recebe os paramentros e trata no outros metodos
		//retorna o comando e os baind com o execute.
		$stmt = $this->query($rawQuery, $params);

		//retorna para o lugar que foi instanciado
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}


}





 ?>
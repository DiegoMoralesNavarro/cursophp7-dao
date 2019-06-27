<?php 



class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){ 
		return $this->idusuario; 
	}

	public function setIdusuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function getDeslogin(){ 
		return $this->deslogin; 
	}

	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}

	public function getDessenha(){ 
		return $this->dessenha; 
	}

	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}

	public function getDtcadastro(){ 
		return $this->dtcadastro; 
	}

	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}


	//

	public function loadById($idusuario){

		//intanciar a outra class para chamar o metodo select

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :id", array(
			":id" => $idusuario
		));

		if(count($result) > 0){
			//como retorna um array podemos usar o valor do indice
			$row = $result[0];

			//passar o valor retornado para o set
					//metodo	//linha  // coluna
			$this->setIdusuario($row['id_usuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}

	}

	// quando não usa this dentro, então pode ser statico
	// função statica não é necessario instancia somente chamar
	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}


	//buscar usuario
	public static function search($losgin){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :search ", array(
			':search'=> '%'.$losgin.'%'
		));

	}


	//consultar validando 2 valores
	public function login($login, $senha){
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios where deslogin = :login AND dessenha = :senha", array(
			':login'=>$login,
			':senha'=>$senha
		));

		if(count($result) > 0){

			$row = $result[0];
					//metodo	//linha  // coluna
			$this->setIdusuario($row['id_usuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}else{
			throw new Exception("login ou senha invalida");
			
		}


	}



	public function __toString(){

		return json_encode(array(
			"id_usuario" => $this->getIdusuario(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y h:i")

		));
	}




}



 ?>
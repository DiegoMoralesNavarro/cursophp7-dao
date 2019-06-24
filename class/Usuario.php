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
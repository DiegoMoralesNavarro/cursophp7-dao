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

			$this->setData($result[0]);
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

			$this->setData($result[0]);
			
		}else{
			throw new Exception("login ou senha invalida");
			
		}


	}

	public function setData($data){
				//metodo	//linha  // coluna
			$this->setIdusuario($data['id_usuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


	public function insert(){
		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if(count($result) > 0){
			$this->setData($result[0]);
		}
	}

							//  = "" passa valor vazio caso não tenha na variavel
	public function __construct($login = "", $senha = ""){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

	}


	public function update($login, $senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :login, dessenha = :senha WHERE id_usuario = :id", array(
			":login" => $this->getDeslogin(),
			":senha" => $this->getDessenha(),
			":id" => $this->getIdusuario()
		));



	}


	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :id", array(
			":id" => $this->getIdusuario()
		));

		//colocar vazio na moria depois de apagar

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
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
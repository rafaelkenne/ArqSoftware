<?php
require "conn.php";

class Funcoes{
	private $con;
	public $cpf;
	public $nome;
	public $telefone;
	public $cep;
	public $ativo;
	
	//CONSTRUTOR
	public function __construct(){
		$this->con = new conn();
	}
	
	function importar(){
		$arquivo = file_get_contents("arquivos/cliente.csv");
		foreach(explode("\n", trim($arquivo)) as $linha){
			$dados = explode(";", $linha);
			$this->cpf = $dados[0];
			$this->nome = $dados[1];
			$this->telefone = $dados[2];
			$this->cep = $dados[3];
			$this->ativo = $dados[4];
			
			$inserir = "INSERT INTO cliente (cpf, nome, telefone, cep, ativo) VALUES ('$this->cpf', '$this->nome', '$this->telefone', '$this->cep', '$this->ativo');";
			$executar = $this->con->getConn()->prepare($inserir);
			$executar->execute();
			
			$pesquisar = "SELECT * FROM cliente";
			$executar = $this->con->getConn()->prepare($pesquisar);
			$executar->execute();
			while($linha = $executar->fetch(PDO::FETCH_ASSOC)):
				$cpf = $linha['cpf'];
				
				if($this->cpf == $cpf):
					$alterar = "UPDATE cliente SET nome = '$this->nome', telefone = '$this->telefone', cep = '$this->cep', ativo = '$this->ativo' WHERE cpf = '$this->cpf'";
					$executar = $this->con->getConn()->prepare($alterar);
					$executar->execute();	
				endif;
			endwhile;	
		}		
	}
	
}

?>
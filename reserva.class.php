<?php
require "conn.php";

class reserva{
	
	public $con;
	public $numero_reserva;
	public $cpf;
	public $numero_quarto;
	public $data_inicio;
	public $data_fim;
	public $checkin;
	public $checkout;
	public $valor_total;
	
	public function __construct(){
		$this->con = new conn();
	}
	
	function buscaQuarto(){
		$busca = "SELECT numero_quarto, acomodacao FROM quarto";
		$executar = $this->con->getConn()->prepare($busca);
		$executar->execute();
		while($linha = $executar->fetch(PDO::FETCH_ASSOC)):
			$numero_quarto = $linha['numero_quarto'];
			$acomodacao = $linha['acomodacao'];
			if($acomodacao == "solteiro2"):
				echo '<option value="'.$numero_quarto.'">'.$numero_quarto.' - Solteiro - Duas camas</option>';
			elseif($acomodacao == "solteiro"):
				echo '<option value="'.$numero_quarto.'">'.$numero_quarto.' - Solteiro - Uma cama</option>';
			else:
				echo '<option value="'.$numero_quarto.'">'.$numero_quarto.' - Casal</option>';
			endif;
		endwhile;
	}
	
	function cadReserva($dados){
        var_dump($dados);
		$this->cpf = $dados['cpf'];
		$this->numero_quarto = $dados['quarto'];
		$this->data_inicio = $dados['data_inicio'];
		$this->data_fim = $dados['data_fim'];
		
		$diferenca = strtotime($this->data_fim) - strtotime($this->data_inicio);
		$dias = floor($diferenca / (60 * 60 * 24));
		
		$quarto = "SELECT * FROM quarto WHERE numero_quarto LIKE '$this->numero_quarto'";
		$consulta_quarto = $this->con->getConn()->prepare($quarto);
		$consulta_quarto->execute();
		
		while($linha = $consulta_quarto->fetch(PDO::FETCH_ASSOC)):
			$valor = $linha['valor'];
			$valor_total = $dias * $valor;
			$cadastrar = "INSERT INTO reserva (data_inicio, data_fim, nro_quarto, cpf_cliente, valor_total) VALUES ('$this->data_inicio', '$this->data_fim', '$this->numero_quarto', '$this->cpf', '$valor_total');";
			$cad_reserva = $this->con->getConn()->prepare($cadastrar);
			$cad_reserva->execute();
		endwhile;
	}
}


?>
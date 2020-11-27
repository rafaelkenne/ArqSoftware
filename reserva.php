<?php
require "reserva.class.php";
$reserva = new reserva();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Hotelaria</title>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="reserva.php">Reservas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="importar">Importar</a>
      </li>
    </ul>
  </div>
</nav>
        
        <form method="POST" action="">
            <div class="form-group">
            	<input type="text" name="cpf" id="cpf" placeholder="Pesquisar pelo CPF">
            </div>
            <div class="form-group">
            	<input type="date" name="data_inicio" id="data_inicio" placeholder="Data Inicial">
            </div>
            <div class="form-group">
            	<input type="date" name="data_fim" id="data_fim" placeholder="Data Final">
            </div>
			<div class="form-group">
        		<select name="quarto">
                	<?php $reserva->buscaQuarto(); ?>
                </select>
        	</div>
            <div class="form-group">
            	Checkin: <input type="checkbox" name="checkin" value="checkin">
            </div>
            <div class="form-group">
            	<input type="submit" value="Cadastrar" name="cad">
            </div>
        </form><br><br>
<?php
if(isset($_POST['cad'])){
	$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$reserva->cadReserva($dados);
}
?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
     $(function () {
       $("#cpf").autocomplete({
          source: 'busca.php'
       });
     });
</script>
</body>
</html>

<?php
require 'connect.inc.php';
	if(isset($_POST['cadastrar_saida'])){
		try {
			$tID = $_POST['ticket'];
			$tHour = $_POST['hora'];
			$vID = $_POST['vaga'];
			$sql = new Sql();
	        $result = $sql->select("SELECT * FROM ticket WHERE tID = :ticket", array(":ticket"=>$tID));
	        $hora = $sql->select("SELECT * FROM ticket WHERE tID = :hora", array(":hora"=>$tHour));
			echo "<script>alert('Ticket reconhecido, redirecionando para página de pagamento!'); window.location = 'payout.php?ticket=".$tID."&hora=".$tHour."&vaga=".$vID."'</script>";
			/*echo "<script>$(window).load(function(){$('#thankyouModal').modal('show');});</script>";*/
		} catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	} else {
		echo "<script>alert('Ticket não reconhecido!');";
	}
?>

<!DOCTYPE html>
<html>
	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Tema opcional -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Última versão JavaScript compilada e minificada -->
	<link rel="stylesheet" href="../app/css/park.css">
	<link rel="stylesheet" href="../app/css/style.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title>Estacionamento</title>
	</head>
<body>
	<div class="container">
		<p class="retirar">
			<a href="checkout.php" title="Retirar carro">
				Retirar carro
			</a>
		</p>
		<div class="row">
			<div class="col-sm-3">
				<div class="logo">
					<a href="../index.php"><img src="../img/logo-top.png" width="110" ></a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="texto">
					<b>Retirar carro</b>
				</div>
			</div>
			<div class="col-sm-3">
				<p>Legenda</p>
				<img src="../img/vaga_disponivel.png" width="40" /> Disponíveis <br>
				<img src="../img/vaga_indisponivel.png" width="40" /> Indisponíveis
			</div>
		</div>
		<div class="row">
		<div class="col-4"></div>
        <div class="centro col-4">
            Olá, seja bem-vindo ao sistema de checkout<br>
            Por favor, informe o número do ticket: 
            <form action="" method="post" name="form_ticket">
            	<input type="text" name="ticket" value="<?php if (isset($ticket)) { echo htmlentities ($ticket); } ?>"><br>
            	<span>Por favor, informe a hora de saída: </span>
            	<input type="text" name="hora" value="<?php if (isset($hora)) { echo htmlentities ($hora); } ?>">
            	<br><span>Por favor, informe o número da vaga: </span>
            	<input type="text" name="vaga" value="<?php if (isset($vaga)) { echo htmlentities ($vaga); } ?>">
            	<input type="submit" name="cadastrar_saida" value="Continuar"></input>
        	</form>
        </div>
		<div class="col-4"></div>
		</div>
	</div>
</body>
</html>
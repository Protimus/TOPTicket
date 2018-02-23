<?php
require 'connect.inc.php';
	if(isset($_POST['cadastrar_entrada'])){
		$user = "root";
		$pass = "vertrigo";
		try {
			/* Faz conexão com o banco de dados */
			$pdo = new PDO('mysql:host=localhost;dbname=estacionamento', $user, $pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/* Executa a inserção do formulário com os dados do cliente */
	        $stmt = $pdo->prepare("INSERT INTO ticket (vID, tEntrada, tPlaca, tModelo) VALUES (:vaga, :entrada, :placa, :modelo)");
	        $stmt->bindParam(':vaga', $_POST['vaga']);
	        $stmt->bindParam(':entrada', $_POST['entrada']);
	        $stmt->bindParam(':placa', $_POST['placa']);
	        $stmt->bindParam(':modelo', $_POST['modelo']);
	        $vaga = $_POST['vaga'];
	        $entrada = $_POST['entrada'];
	        $placa = $_POST['placa'];
	        $modelo = $_POST['modelo'];
	        $stmt->execute();
	        /* Executa a alteração de status da vaga para ocupado */
	        $stmt = $pdo->prepare("UPDATE vagas SET vStatus = :vStatus WHERE vID = :vaga");
	        $stmt->bindParam(':vStatus', $vStatus);
	        $stmt->bindParam(':vaga', $vID);
	        $vID = $_POST['vaga'];
	        $vStatus = '1';
			$stmt->execute();
			echo "<script>alert('Cadastro efetuado com sucesso!'); window.location = '../index.php'</script>";
		} catch(PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
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
					<b>Cadastro</b>
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
				<form action="" method="post" name="form_cadastrar">
					Placa do carro: <input type="text" name="placa" value="<?php if (isset($placa)) { echo htmlentities ($placa); } ?>"><br>
					Modelo do carro: <input type="text" name="modelo" value="<?php if (isset($modelo)) { echo htmlentities ($modelo); } ?>"><br>
					Horarário de chegada: <input type="text" name="entrada" value="<?php if (isset($entrada)) { echo htmlentities ($entrada); } ?>"><br>
					Número da vaga: <input type="text" name="vaga" value="<?php echo $_GET['vaga']; if (isset($vaga)) { echo htmlentities ($vaga); }?>"><br>
					<input type="submit" name="cadastrar_entrada" value="Cadastrar"></input>
				</form>
			</div>
		<div class="col-4"></div>
		</div>
	</div>
</body>
</html>

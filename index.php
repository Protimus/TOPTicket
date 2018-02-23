<html>
	<head>
	<!-- Última versão CSS compilada e minificada -->
		<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Tema opcional -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Última versão JavaScript compilada e minificada -->
		<link rel="stylesheet" href="app/css/park.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<title>Estacionamento</title>
		</head>
	<body>
		<div class="container">
			<p class="retirar">
				<a href="app/checkout.php" title="Retirar carro">
					Retirar carro
				</a>
			</p>
			<div class="row">
				<div class="col-sm-3">
					<div class="logo">
						<a href="index.php"><img src="img/logo-top.png" width="110" ></a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="texto">
						Selecione a vaga desejada
					</div>
				</div>
				<div class="col-sm-3">
					<p>Legenda</p>
					<img src="img/vaga_disponivel.png" width="40" /> Disponíveis <br>
					<img src="img/vaga_indisponivel.png" width="40" /> Indisponíveis
				</div>
			</div>
			<div id ="vagas">
				<?php
				require 'app/connect.inc.php';
				$vagas = array();
				$vagasNum = 81; // Variável de contador para o número de poltronas
				for ($i = 1; $i < $vagasNum; $i++){
					$sql = new Sql(); 
					$consulta_vaga = $sql->select("SELECT vStatus FROM vagas WHERE vID = ".$i);
					if (@$consulta_vaga[0]['vStatus'] == 0){
						echo "<span class='vaga' data-vaga='".$i."'></span>";
					} else {
						echo "<span class='vaga indisponivel' data-vaga='".$i."'></span>";
					}
				}
				?>
			</div>
		</div>
		<script type="text/javascript">
		$(function(){
			$('.vaga').on('click',function(){
				var classe = $(this).attr('class');
				var vaga = $(this).attr('data-vaga');
				if(classe.indexOf('indisponivel')>0){
					alert('A vaga '+(parseInt(vaga))+' está indisponível. Por favor, selecione outra vaga.');
				} else {
					window.location = "app/checkin.php?vaga="+vaga;
				}
			});
		});
		$(function(){
            $('.poltronas .poltrona').on("click", function(){
                var classe = $(this).attr('class');
                var campo = $(this).next();
                if(classe.indexOf('selecionada')>0){
                    $(this).removeClass('selecionada');
                    campo.attr("value","0");
                }else{
                    $(this).addClass('selecionada');
                    campo.attr("value","2");
                }
                if(classe.indexOf('ocupada')>0){
                    alert('Lugar indisponível, selecione outra poltrona!');
                    campo.attr("value","1");
                }
            });
        });
		</script>
 	</body>
</html>

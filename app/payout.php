<?php
require 'connect.inc.php';
    if(isset($_GET['ticket'])){
        try {
            $tID = $_GET['ticket'];
            $tHour = $_GET['hora'];
            $vStatus = '0'; 
            $vID = $_GET['vaga'];
            $sql = new Sql();
            #echo $result[0]['tEntrada'];
            //$livre = $pdo->prepare("UPDATE vagas SET vStatus = :vStatus WHERE vID = :vaga", array(":vStatus"=>$vStatus, ":vID"=>$));
            $entrada = $sql->select("SELECT tEntrada FROM ticket WHERE tID = :ticket", array(":ticket"=>$tID));
            /* Executa a alteração de status da vaga para disponivel */
            $altera = $sql->query("UPDATE vagas SET vStatus = :vStatus WHERE vID = :vaga", array(":vaga"=>$vID, ":vStatus"=>$vStatus));
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
                    <b>Pagamento</b>
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
        O número do ticket é: <?php echo $tID; ?><br>
        <?php
            /* Função que calcula o valor total a pagar por hora */
                $total = 0; 
                $hora_total = ($entrada[0]['tEntrada'] - $tHour); 
                if($hora_total <= 1){
                    $total = 3.50;
                } else if ($hora_total > 1 && $hora <= 2) { 
                    $total = 5; 
                } else {
                    $total = 3;
                }
                echo "O total a pagar e: R$ $total";
        ?>
        <br><br>
        <div class="pagar"><button type="button" class="btn btn-success">Pagar</button></div>
        </div>
        <div class="col-4"></div>
        </div>
    </div>
</body>

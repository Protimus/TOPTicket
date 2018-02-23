<?php
// Criação de classe para SQL
	class Sql extends PDO { 
		private $conn; // Variável de conexão
		private $host = "localhost"; // Variável para definição do host
		private $dbname = "estacionamento"; // Variável para definição do nome de banco de dados
		private $user = "root"; // Variável para definição de usuário do banco
		private $pass = "vertrigo"; // Variável para definição de senha do banco
		
		//conexão automática com o banco de dados após a instaciação (new)
		public function __construct(){
			// Realiza teste de conexão com o banco
				$this->conn = new PDO("mysql:host=localhost;dbname=estacionamento","root", "vertrigo");
		}

		private function setParams($statement, $parameters = array()){
			foreach ($parameters as $key => $value){
				$this->setParam($statement, $key, $value);
			}
		}
		
		private function setParam($statement, $key, $value){
			$statement->bindParam($key, $value);
		}
		
		// Execução de comando
		public function query($rawQuery, $params = array()){  
			$stmt = $this->conn->prepare($rawQuery); 
			$this->setParams($stmt, $params);
			$stmt->execute();
			return $stmt;
		}
		
		// Realiza uma consulta
		public function select($rawQuery, $params = array()){ 
			$stmt = $this->query($rawQuery, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>
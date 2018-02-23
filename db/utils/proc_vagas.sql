/* PROCEDURE relacionada a população de vagas padrões */
USE estacionamento;
DROP PROCEDURE IF EXISTS ADDVAGAS;
DELIMITER $$
CREATE PROCEDURE ADDVAGAS()
	BEGIN
	
	SET @INICIO = 0;  
	SET @FIM = 80;
	WHILE @INICIO < @FIM 
	DO 
		INSERT INTO vagas (vStatus) values (0); 
		SET @INICIO = @INICIO + 1;
	END WHILE;
END$$ 

/* Realiza chamado da procedure */
/* CALL ADDVAGAS();*/
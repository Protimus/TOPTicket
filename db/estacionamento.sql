/* 	BANCO DE DADOS PARA ESTACIONAMENTO 
* - UTILIZAÇÃO DE NORMALIZAÇÃO EM 3FN */

CREATE DATABASE estacionamento;
use estacionamento;

/* Tabela de vagas 
- vStatus:
  0 = Livre
  1 = Ocupada
*/
CREATE TABLE vagas (
  vID smallint NOT NULL AUTO_INCREMENT,
  vStatus INT  NOT NULL DEFAULT 0,
	PRIMARY KEY (vID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Tabela de ticket */
CREATE TABLE ticket (
  tID int NOT NULL AUTO_INCREMENT,
  vID smallint NOT NULL,
  tEntrada DATETIME DEFAULT NULL,
  tPlaca varchar(50) DEFAULT NULL,
  tModelo varchar(50) DEFAULT NULL,
  PRIMARY KEY (tID),
  FOREIGN KEY (vID) REFERENCES vagas(vID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

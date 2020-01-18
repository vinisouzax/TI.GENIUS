create database bdfeedback;
use bdfeedback;


CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nmCategoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
);

CREATE TABLE IF NOT EXISTS `regra` (
  `idRegra` int(11) NOT NULL AUTO_INCREMENT,
  `nmRegra` varchar(50) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `solucao` varchar(300) NOT NULL,
  PRIMARY KEY (`idRegra`),
  KEY `idCategoria` (`idCategoria`)
);

CREATE TABLE IF NOT EXISTS `regraxvariavel` (
  `idRegraXVariavel` int(11) NOT NULL AUTO_INCREMENT,
  `idRegra` int(11) NOT NULL,
  `idVariavel` int(11) NOT NULL,
  `idValor` int(11) NOT NULL,
  PRIMARY KEY (`idRegraXVariavel`),
  KEY `FK_RegraVariavel` (`idRegra`),
  KEY `FK_VariavelRegra` (`idVariavel`)
);

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nmLogin` varchar(45) NOT NULL,
  `nmUsuario` varchar(200) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivelAcesso` varchar(17) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`idUsuario`)
);

INSERT INTO `usuario` (`idUsuario`, `nmLogin`, `nmUsuario`, `senha`, `nivelAcesso`, `email`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'admin@gmail.com');


CREATE TABLE IF NOT EXISTS `valor` (
  `idValor` int(11) NOT NULL AUTO_INCREMENT,
  `nmValor` varchar(50) NOT NULL,
  `idVariavel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idValor`),
  KEY `fk_variavel_valor` (`idVariavel`)
);

CREATE TABLE IF NOT EXISTS `variavel` (
  `idVariavel` int(11) NOT NULL AUTO_INCREMENT,
  `nmVariavel` varchar(50) NOT NULL,
  `pergunta` varchar(200) NOT NULL,
  PRIMARY KEY (`idVariavel`)
);


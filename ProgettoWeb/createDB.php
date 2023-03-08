<?php

include_once 'DBconnection.php';

$queryDB = array();

$queryDB[0]="CREATE DATABASE IF NOT EXISTS centroReclami DEFAULT CHARACTER SET = utf8;";
$queryDB[1]="USE centroReclami;";

$queryDB[2] = "
CREATE TABLE Comune(
    idComune INT(5) NOT NULL AUTO_INCREMENT,
    nomeComune char(10) NOT NULL,
    PRIMARY KEY(idComune)
)ENGINE = InnoDB;";


$queryDB[3] = "CREATE TABLE Persona (
    idPersona INT(5) NOT NULL AUTO_INCREMENT,
    nome char(10) NOT NULL,
    cognome char (10) NOT NULL,
    codiceFiscale char(16) NOT NULL UNIQUE,
    numeroTelefono char(10) NOT NULL,
    indirizzo char(20) NOT NULL,
    tipo boolean NOT NULL,
    dataNascita date NOT NULL,
    email char(30) NOT NULL,
    passwordP char(30) NOT NULL UNIQUE,
    idComune INT(5) NOT NULL,
    PRIMARY KEY(idPersona),
    FOREIGN KEY(idComune) REFERENCES Comune(idComune)
    	ON UPDATE CASCADE
        ON DELETE CASCADE
)ENGINE = InnoDB;";


$queryDB[4] = "CREATE TABLE Problema (
    idProblema INT(5) NOT NULL AUTO_INCREMENT,
    descrizioneProblema char(40) NOT NULL,
    indirizzoProblema char(20) NOT NULL,
    dataReclamo date NOT NULL,
    stato boolean NOT NULL,
    idComune INT(5) NOT NULL,
    tipo boolean NOT NULL,
    PRIMARY KEY(idProblema),
    FOREIGN KEY(idComune) REFERENCES Comune(idComune)
    	ON UPDATE CASCADE
        ON DELETE CASCADE
)ENGINE = InnoDB;";


for ($i = 0; $i < count($queryDB); $i++) {
    $result = mysqli_query($connetti, $queryDB[$i]);
}






<?php
include_once 'DBconnection.php';

$queryDB = "

CREATE DATABASE IF NOT EXISTS centroReclami DEFAULT CHARACTER SET = utf8;

USE centroReclami;

CREATE TABLE Comune(
    idComune INT(5) NOT NULL AUTO_INCREMENT,
    nomeComune char(10) NOT NULl,
    PRIMARY KEY(idComune)
)ENGINE = InnoDB;
    
    
CREATE TABLE Persona (
    idPersona INT(5) NOT NULL AUTO_INCREMENT,
    nome char(10) NOT NULL,
    cognome char (10) NOT NULL,
    codiceFiscale char(16) NOT NULL UNIQUE,
    numeroTelefono char(10) NOT NULL ,
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
)ENGINE = InnoDB;
    
CREATE TABLE Reclamo(
    idReclamo INT(5) NOT NULL AUTO_INCREMENT,
    descrizione char(20) NOT NULL,
    idComune INT(5) NOT NULL,
    PRIMARY KEY(idReclamo),
    FOREIGN KEY(idComune) REFERENCES Comune(idComune)
    	ON UPDATE CASCADE
        ON DELETE CASCADE
)ENGINE = InnoDB;

CREATE TABLE Problema (
    idProblema INT(5) NOT NULL AUTO_INCREMENT,
    descrizioneProblema char(20) NOT NULL,
    idComune INT(5) NOT NULL,
    tipo boolean NOT NULL,
    PRIMARY KEY(idProblema),
    FOREIGN KEY(idComune) REFERENCES Comune(idComune)
    	ON UPDATE CASCADE
        ON DELETE CASCADE
)ENGINE = InnoDB;
    

CREATE TABLE Presenta(
    idPersona INT(5) NOT NULL,
    idReclamo INT(5) NOT NULL,
    DataReclamo date NOT NULL,
    OraReclamo time NOT NULL,
    PRIMARY KEY(idPersona,idReclamo),
    FOREIGN KEY(idPersona) REFERENCES Persona(idPersona)
    	ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY(idReclamo) REFERENCES Reclamo(idReclamo)
    	ON UPDATE CASCADE
        ON DELETE CASCADE
)ENGINE = InnoDB;
";

$result = mysqli_query($connetti, $preQuery);

if (mysqli_num_rows($result) != 0) {
    echo "creato";
} else {
    echo "errore";
}

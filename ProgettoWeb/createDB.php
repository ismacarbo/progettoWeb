<?php

include_once 'DBconnection.php';

$queryDB = array();

$queryDB[0]="CREATE DATABASE IF NOT EXISTS centroreclami DEFAULT CHARACTER SET = utf8;";
$queryDB[1]="USE centroreclami;";

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

$queryDB[5]="CREATE TABLE chatbot (
    idBot int AUTO_INCREMENT PRIMARY KEY,
    messaggio varchar(200) NOT NULL,
    risposta varchar(200) NOT NULL
    );";

$queryDB[6]="INSERT INTO `chatbot` (`idBot`, `messaggio`, `risposta`) "
        . "VALUES (NULL, 'Ciao|ei|Ei|Bella|ciao|bella|we', 'Ciao, come posso aiutarti?'),"
        . " (NULL, 'Come stai?|come stai|come va|Come va|Come va?', 'Tutto ok!'), (NULL, 'Chi sei?|chi sei|chi sei?', "
        . "'Sono il ChatBot della azienda Centro Reclami del comune di Folgaria'), (NULL, 'Cosa puoi fare?|cosa puoi fare?|cosa fai', "
        . "'Posso consigliarti delle zone in cui effettuare delle richieste di costruzione o mostrarti dove altre persone hanno effettuato dei reclami, "
        . "per esempio'), (NULL, 'reclami|Reclami|costruzione|Costruzioni|costruzioni', 'Certo! Ecco qui una lista di tutti i reclami e richieste effettuati "
        . "da altre persone fino ad ora')";

$queryDB[7]="ALTER TABLE chatbot ADD COLUMN consigli varchar(200) NOT NULL";

$queryDB[8]="INSERT INTO chatbot(consigli)
VALUES('strade a servizio degli insediamenti:Folgaria'),('parcheggio:Nosellari'),('miglioramento rete idrica: Carbonare'),('riparazione pubblica illuminazione:Tezzeli'),('rinnovamento parco giochi:San Sebastiano')";

$queryDB[9]="ALTER TABLE persona
ADD COLUMN recensione int(100) NOT NULL DEFAULT 0";

$queryDB[10]="INSERT INTO `chatbot` (`idBot`, `messaggio`, `risposta`) VALUES (NULL, 'consigliami|zona|zone|consiglio|consigli', 'Certo! Ecco delle zone in cui poter effettuare delle nuove costruzioni!')";


for ($i = 0; $i < count($queryDB); $i++) {
    $result = mysqli_query($connetti, $queryDB[$i]);
}






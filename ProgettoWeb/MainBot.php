<?php

session_start();
$reclami = array("reclami", "Reclami", "costruzione", "Costruzioni", "costruzioni");
$consigli = array("consigliami", "zona", "zone", "consiglio", "consigli");
$conn = mysqli_connect("localhost", "root", "", "centroreclami");

if ($conn) {
    $messaggiUtente = mysqli_real_escape_string($conn, $_POST['messageValue']);

    $query = "SELECT * FROM chatbot WHERE messaggio LIKE '%$messaggiUtente%'";
    $runQuery = mysqli_query($conn, $query);

    if (mysqli_num_rows($runQuery) > 0) {
        $result = mysqli_fetch_assoc($runQuery);
        echo $result['risposta'];

        if (in_array($messaggiUtente, $reclami)) {
            $queryReclamo = "SELECT idProblema,descrizioneProblema,indirizzoProblema,dataReclamo,stato from problema";
            $runQuery2 = mysqli_query($conn, $queryReclamo);
            if (mysqli_num_rows($runQuery2) > 0) {
                $result = mysqli_fetch_all($runQuery2);
                for ($i = 0; $i < count($result); $i++) {
                    echo "<br>" . $result[$i][1] . ": " . $result[$i][2] . "<br>";
                }
            }
        }

        if (in_array($messaggiUtente, $consigli)) {
            $consigli2 = array("strade a servizio degli insediamenti: Folgaria", "parcheggio: Nosellari", "miglioramento rete idrica: Carbonare", "riparazione pubblica illuminazione: Tezzeli", "rinnovamento parco giochi: San Sebastiano");
            for ($i = 0; $i < count($consigli2); $i++) {
                $temp = explode(":", $consigli2[$i]);
                echo "<br>" . $temp[0] . ": " . $temp[1] . "<br>";
            }
        }
    } else {
        echo "Scusa, non ho capito!";
    }
} else {
    echo "errore " . mysqli_connect_errno();
}
?>
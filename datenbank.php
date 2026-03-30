<?php 
require_once ('Verbindungsdaten.php');

//Create Connection
$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

//Check Connection
if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

$sql = "select KdNr, Nachname, Vorname from kundennummer";
//Executing the SQL query
$result = $conn->query($sql);

$kunden=[];

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kunden[]=$row;
    }
}

$conn->close();

include 'tabelle.php';
?>
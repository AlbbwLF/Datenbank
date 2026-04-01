<?php
require_once('Verbindungsdaten.php');

//Create Connection
$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

//Check Connection
if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

//Durch alle Nachnamen gehen
foreach ($_POST['Nachname'] as $KdNr -> $Nachname) {
    $Vorname = $_POST['Vorname'][ $KdNr];

    $sql = "Update kunden set Nachname='$Nachname', Vorname='$Vorname' where KdNr=$KdNr";
    $conn->query($sql);
}
$conn->close();

header("location: index.php");
exit;
?>
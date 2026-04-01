<?php
require_once('Verbindungsdaten.php');

$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

if(empty($_POST)){
    die("Keine Daten empfangen");
}

$stmt = $conn->prepare("UPDATE kundennummer SET Nachname = ?, Vorname = ? WHERE KdNr = ?");

if(!$stmt){
    die("SQL Fehler: " . $conn->error);
}

foreach ($_POST['Nachname'] as $KdNr => $Nachname) {
    $Vorname = $_POST['Vorname'][$KdNr] ?? '';

    $stmt->bind_param("ssi", $Nachname, $Vorname, $KdNr);
    $stmt->execute();
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
?>
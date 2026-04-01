<?php
require_once('Verbindungsdaten.php');

$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

if(empty($_POST)){
    die("Keine Daten empfangen");
}

$stmt = $conn->prepare("UPDATE kundennummer SET 
Nachname = ?,
Vorname = ?,
BstNr = ?,
Datum = ?,
ArNr = ?,
ArAz = ?,
ArNm = ?,
Preis = ?
  WHERE KdNr = ?");

if(!$stmt){
    die("SQL Fehler: " . $conn->error);
}

foreach ($_POST['Nachname'] as $KdNr => $Nachname) {
    $Vorname = $_POST['Vorname'][$KdNr] ?? '';
    $BstNr = $_POST['BstNr'][$KdNr] ?? 0;
    $Datum = $_POST['Datum'][$KdNr] ?? null;
    $ArNr = $_POST['ArNr'][$KdNr] ?? 0;
    $ArAz = $_POST['ArAz'][$KdNr] ?? 0;
    $ArNm = $_POST['ArNm'][$KdNr] ??'';
    $Preis = $_POST['Preis'][$KdNr] ?? 0;
    //Parameter s=string i=integer und d=double 
    $stmt->bind_param("ssissisdi", $Nachname, $Vorname, $BstNr, $Datum, $ArNr, $ArAz, $ArNm, $Preis, $KdNr);
    $stmt->execute();
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
?>
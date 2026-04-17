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
    $Datum = $_POST['Datum'][$KdNr] ?? '0000-00-00';
    $ArNr = $_POST['ArNr'][$KdNr] ?? 0;
    $ArAz = $_POST['ArAz'][$KdNr] ?? 0;
    $ArNm = $_POST['ArNm'][$KdNr] ??'';
    $Preis = $_POST['Preis'][$KdNr] ?? 0;
    //Parameter s=string i=integer und d=double 
    $stmt->bind_param("ssiiiisdi", $Nachname, $Vorname, $BstNr, $Datum, $ArNr, $ArAz, $ArNm, $Preis, $KdNr);
    if(!$stmt->execute()){
        die("Fehler beim Update KdNr $KdNr: " . $stmt->error);
    };
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
?>
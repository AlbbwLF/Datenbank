<?php
require_once('Verbindungsdaten.php');

$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

if(empty($_POST)){
    die("Keine Daten empfangen");
}

$stmtKunde = $conn->prepare("UPDATE kundennummer SET 
Nachname = ?,
Vorname = ?
  WHERE KdNr = ?");

  $stmtBestellungen = $conn->prepare("UPDATE bestellungen
  SET Datum = ? 
  WHERE BstNr = ?");

$stmtPosition = $conn->prepare("UPDATE bestellposition 
SET ArAz = ?
WHERE BstNr = ? and ArNr = ?");

$stmtArtikel = $conn->prepare("UPDATE artikel
SET ArNm = ?, Preis = ?
Where ArNr = ?");

if(!$stmtKunde || !$stmtBestellungen || !$stmtPosition || !$stmtArtikel){
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
    // 1. Kundennummer Tabelle
    $stmtKunde->bind_param("ssi", $Nachname, $Vorname,$KdNr);
    $stmtKunde->execute();

    //2. Bestellungen Tabelle
    if ($BstNr > 0){
        $stmtBestellung->bind_param("si", $Datum, $BstNr);
        $stmtBestellung->execute();
    }

    //3. Bestellposition Tabelle
    if ($BstNr > 0 && $ArNr > 0) {
        $stmtPosition->bind_param("iii", $ArAz, $BstNr, $ArNr);
        $stmtPosition->execute();
    }

    // 4. Artikel
    if ($ArNr > 0) {
        $stmtArtikel->bind_param("sdi", $ArNm, $Preis, $ArNr);
        $stmtArtikel->execute();
    }
}

$stmtKunde->close();
$stmtBestellungen->close();
$stmtPosition->close();
$stmtArtikel->close();

$conn->close();

header("Location: index.php");
exit;
?>
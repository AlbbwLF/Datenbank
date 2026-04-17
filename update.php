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

$stmtInsertKunde = $conn->prepare("INSERT INTO kundennummer (Nachname, Vorname)
values (?, ?)");

$stmtInsertBestellung = $conn->prepare("INSERT INTO bestellungen (KdNr, Datum)
values (?, ?)");

$stmtInsertPosition = $conn->prepare("INSERT INTO bestellposition (BstNr, ArNr, ArAz) 
    VALUES (?, ?, ?)
");

$stmtUpsertArtikel = $conn->prepare("
    INSERT INTO artikel (ArNr, ArNm, Preis)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE
    ArNm = VALUES(ArNm),
    Preis = VALUES(Preis)
");

if(!$stmtKunde || !$stmtBestellungen || !$stmtPosition || !$stmtArtikel || !$stmtInsertKunde || !$stmtInsertBestellung || !$stmtInsertPosition || !$stmtUpsertArtikel){
    die("SQL Fehler: " . $conn->error);
}

foreach ($_POST['Nachname'] as $key => $Nachname) {
    if ($key === "new") {

    $Vorname = $_POST['Vorname'][$key] ?? '';
    $Datum = $_POST['Datum'][$key] ?? null;
    $ArNr = $_POST['ArNr'][$key] ?? 0;
    $ArAz = $_POST['ArAz'][$key] ?? 0;
    $ArNm = $_POST['ArNm'][$key] ?? '';
    $Preis = $_POST['Preis'][$key] ?? 0;

    //1. Kunden anlegen
    $stmtInsertKunde-> bind_param("ss", $Nachname, $Vorname);
    $stmtInsertKunde->execute();
//bei neuem Kunden
    $KdNr = $conn->insert_id; 

       // 2. Bestellung
        if ($Datum) {
            $stmtInsertBestellung->bind_param("is", $KdNr, $Datum);
            $stmtInsertBestellung->execute();

            $BstNr = $conn->insert_id;

            // 3. Bestellposition festlegen
            if ($ArNr > 0) {
                $stmtInsertPosition->bind_param("iii", $BstNr, $ArNr, $ArAz);
                $stmtInsertPosition->execute();
            }
        }

        // 4. Artikel anlegen
        if ($ArNr > 0) {
        $stmtUpsertArtikel->bind_param("isd", $ArNr, $ArNm, $Preis);
        $stmtUpsertArtikel->execute();
}

    }else{

list($KdNr, $BstNr, $ArNr) = explode("_", $key);

    $Vorname = $_POST['Vorname'][$key] ?? '';
    $Datum = $_POST['Datum'][$key] ?? '0000-00-00';
    $ArAz = $_POST['ArAz'][$key] ?? 0;
    $ArNm = $_POST['ArNm'][$key] ??'';
    $Preis = $_POST['Preis'][$key] ?? 0;

    //Parameter s=string i=integer und d=double 
    // 1. Kundennummer Tabelle
    $stmtKunde->bind_param("ssi", $Nachname, $Vorname,$KdNr);
    $stmtKunde->execute();

    //2. Bestellungen Tabelle
    if ($BstNr > 0){
        $stmtBestellungen->bind_param("si", $Datum, $BstNr);
        $stmtBestellungen->execute();
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
}

$stmtKunde->close();
$stmtBestellungen->close();
$stmtPosition->close();
$stmtArtikel->close();

$conn->close();

header("Location: index.php");
exit;
?>
<?php 
require_once ('Verbindungsdaten.php');

//Create Connection
$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

//Check Connection
if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

$sql = "select 
k.KdNr, 
k.Nachname, 
k.Vorname, 
b.BstNr, 
b.Datum, 
c.ArNr, 
c.ArAz, 
a.ArNm, 
a.Preis 
FROM kundennummer k
LEFT JOIN bestellungen b ON k.KdNr = b.KdNr
LEFT JOIN bestellposition c ON b.BstNr = c.BstNr
LEFT JOIN artikel a ON c.ArNr = a.ArNr";
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
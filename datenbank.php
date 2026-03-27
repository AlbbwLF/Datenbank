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

//Processing the result set
if ($result->num_rows > 0) {
    //Outputting the data of each row
    while ($row = $result->fetch_assoc()) {
        echo"KdNr: ". $row["KdNr"] ." Name: ". $row["Nachname"]." Vorname: ". $row["Vorname"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
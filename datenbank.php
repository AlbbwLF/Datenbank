<?php 
require_once ('Verbindungsdaten.php');

//Create Connection
$conn = new mysqli($datenbank_host, $datenbank_user, $datenbank_passwort, $datenbank_name);

//Check Connection
if ($conn->connect_error) {
    die('Verbindung fehlgeschlagen: '. $conn->connect_error);
}

echo "<h1>Kundendaten</h1>";

$sql = "select KdNr, Nachname, Vorname from kundennummer";
//Executing the SQL query
$result = $conn->query($sql);

//Processing the result set
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>KdNr</th><th>Nachname</th><th>Vorname</th></tr>";
    //Outputting the data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["KdNr"]."</td>";
        echo "<td>".$row["Nachname"]."</td>";
        echo "<td>".$row["Vorname"]."</td>";
    }
    echo "</table>";
} else {
    echo "Keine Einträge gefunden.";
}

$conn->close();
?>
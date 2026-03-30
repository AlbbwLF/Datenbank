<?php
echo "<h1>Kundendaten</h1>";

if(!empty($kunden)){
    echo "<table class='kunden-tabelle'>";
    echo"<tr><th>KdNr</th><th>Nachname</th><th>Vorname</th></tr>";

    foreach($kunden as $row) {
        echo "<tr>";
        echo "<td>{$row['KdNr']}</td>";
        echo "<td>{$row['Nachname']}</td>";
        echo "<td>{$row['Vorname']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Keine Einträge gefunden.";
}
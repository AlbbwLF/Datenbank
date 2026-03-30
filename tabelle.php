<?php
echo "<h1>Kundendaten</h1>";

if(!empty($kunden)){
    echo "<table class='kunden-tabelle'>";
    echo"<tr><th>KdNr</th>
    <th>Nachname</th>
    <th>Vorname</th>
    <th>Bestellnummer</th>
    <th>Datum</th>
    <th>Artikelnummer</th>
    <th>Artikel Anzahl</th>
    <th>Artikelname</th>
    <th>Preis</th>
    </tr>";

    foreach($kunden as $row) {
        echo "<tr>";
        echo "<td>{$row['KdNr']}</td>";
        echo "<td>{$row['Nachname']}</td>";
        echo "<td>{$row['Vorname']}</td>";
        echo "<td>{$row['Bestellnummer']}</td>";
        echo "<td>{$row['Datum']}</td>";
        echo "<td>{$row['Artikelnummer']}</td>";
        echo "<td>{$row['Artikel Anzahl']}</td>";
        echo "<td>{$row['Artikelname']}</td>";
        echo "<td>{$row['Preis']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Keine Einträge gefunden.";
}
<form method="post" action="update.php">
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
        echo "<td><input type='text' name='KdNr[{$row['KdNr']}]' value='{$row['KdNr']}'></td>";
        echo "<td><input type='text name='Nachname[{$row['Nachname']}]' value='{$row['Nachname']}'></td>";
        echo "<td><input type='text' name='Vorname[{$row['Vorname']}]' value='{$row['Vorname']}'></td>";
        echo "<td><input type='number' name='BstNr[{$row['BstNr']}]' value='{$row['BstNr']}'></td>";
        echo "<td><input type='date' name='Datum[{$row['Datum']}]' value='{$row['Datum']}'></td>"; 
        echo "<td><input type='number' name='ArNr[{$row['ArNr']}]' value='{$row['ArNr']}'></td>";
        echo "<td><input type='number' name='ArAz[{$row['ArAz']}]' value='{$row['ArAz']}'></td>";
        echo "<td><input type='text' name='ArNm[{$row['ArNm']}]' value='{$row['ArNm']}'></td>";
        echo "<td><input type='number' name='Preis€[{$row['Preis']}]' value='{$row['Preis']}'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<button type='button' id='submitButton'>Änderungen speichern</button>";
} else {
    echo "Keine Einträge gefunden.";
}
?>
</form>
<script>
    document.addEventListener(
        'DOMContentLoaded', () => {
            document.getElementById('submitButton').addEventListener('click', function (){
                alert('Form submitted!');
            });
        });
</script>
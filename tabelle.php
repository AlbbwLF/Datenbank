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

    $key = $row['KdNr'] . "_" . $row['BstNr'] . "_" . $row ['ArNr'];

        echo "<tr>";
        echo "<td><input type='text' name='KdNr[$key]' value='{$row['KdNr']}' readonly></td>";
        echo "<td><input type='text' name='Nachname[$key]' value='{$row['Nachname']}'></td>";
        echo "<td><input type='text' name='Vorname[$key]' value='{$row['Vorname']}'></td>";
        echo "<td><input type='number' name='BstNr[$key]' value='{$row['BstNr']}'></td>";
        echo "<td><input type='date' name='Datum[$key]' value='{$row['Datum']}'></td>";
        echo "<td><input type='number' name='ArNr[$key]' value='{$row['ArNr']}'></td>";
        echo "<td><input type='number' name='ArAz[$key]' value='{$row['ArAz']}'></td>";
        echo "<td><input type='text' name='ArNm[$key]' value='{$row['ArNm']}'></td>";
        echo "<td><input type='number' step='0.01' name='Preis[$key]' value='{$row['Preis']}'></td>";
        echo "<input type='hidden' name='ids[$key]' value='$key'>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<tr>";
    echo "<h1>Neuer Eintrag</h1>";
    echo "<br>";
    echo "<td><input type='text' name='Nachname[new]' ></td>";
    echo "<td><input type='text' name='Vorname[new]' ></td>";
    echo "<td><input type='number' name='BstNr[new]' ></td>";
    echo "<td><input type='date' name='Datum[new]' ></td>";
    echo "<td><input type='number' name='ArNr[new]' ></td>";
    echo "<td><input type='number' name='ArAz[new]' ></td>";
    echo "<td><input type='text' name='ArNm[new]' ></td>";
    echo "<td><input type='number' step='0.01' name='Preis[new]' ></td>";
    echo "</tr>";
    echo "<br>";
    echo "<button type='submit' id='submitButton'>Änderungen speichern</button>";
} else {
    echo "Keine Einträge gefunden.";
}
?>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('submitButton');
        if (btn) {
            btn.addEventListener('click', () => {
                alert('Form submitted');
            })
        }
    });
</script>
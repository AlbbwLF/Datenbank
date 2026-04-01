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
        $id = $row['KdNr'];
        echo "<tr>";
        echo "<td><input type='text' name='KdNr[{$row['KdNr']}]' value='{$row['KdNr']}'></td>";
        echo "<td><input type='text' name='Nachname[$id]' value='{$row['Nachname']}'></td>";
        echo "<td><input type='text' name='Vorname[$id]' value='{$row['Vorname']}'></td>";
        echo "<td><input type='number' name='BstNr[$id]' value='{$row['BstNr']}'></td>";
        echo "<td><input type='date' name='Datum[$id]' value='{$row['Datum']}'></td>"; 
        echo "<td><input type='number' name='ArNr[$id]' value='{$row['ArNr']}'></td>";
        echo "<td><input type='number' name='ArAz[$id]' value='{$row['ArAz']}'></td>";
        echo "<td><input type='text' name='ArNm[$id]' value='{$row['ArNm']}'></td>";
        echo "<td><input type='number' step='0.01 'name='Preis[$id]' value='{$row['Preis']}'></td>";
        echo "</tr>";
    }
    echo "</table>";
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
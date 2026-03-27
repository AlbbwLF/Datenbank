<?php 
require_once ('Verbindungsdaten.php');
$db_link = mysqli_connect (
    $datenbank_host,
    $datenbank_user, 
    $datenbank_passwort,
    $datenbank_name
);
if ($db_link){
    echo 'Verbindung erfolgreich: ';
    print_r($db_link);
} 
else {
    die('Keine Verbindung möglich: ' .mysqli_error());
    }
?>
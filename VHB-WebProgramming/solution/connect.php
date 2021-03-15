<!DOCTYPE html>                                                                             <!-- HMTL Dokument wurde nicht deklariert -->
<html>                                                                                      <!-- HTML Root Element fehlt-->

<head>                                                                                      <!-- HTML Head fehlt: Style sollte im Head definiert werden -->
    <style>
        .kachel {
            width: 150px;
            height: 230px;
            float: left;
            border: 1px solid #666;
            margin: 5px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        .kachel .title {
            height: 30px;
            padding-left: 5px;
            margin-bottom: 5px;
        }

        .kachel .date {
            height: 30px;
            padding-left: 5px;
        }

        .kachel .img {
            width: 120px;
            height: 170px;
        }
    </style>
</head>

<body>                                                                                      <!-- HTML Body fehlt: HTML Code sollte im Body definiert werden -->
    <h1>James Bond</h1>
</body>

</html>

<?php                                                                                       // Die Verwendung der Langform <?php ist zu empfehlen, da XML ebenso Processing Instruction Blöcke vewendet
include('connect.inc.php');                                                                 // Sofern connect.inc.php bereits eine Verbindung zur Datenbank aufgebaut hat, können untere SQL Statements erfolgen 
global $connection;                                                                         // In PHP 7 muss die connection aus dem connect.inc.php global definiert werden, da sie später für sqli Methoden benötigt wird


$query = "SELECT id, title, release_date FROM movies ORDER BY title ASC";                   // Attribut release_date fehlt im SELECT und Attribut title hat einen Tippfehler im ORDER BY
$result = mysqli_query($connection, $query);                                                // In PHP 7 wird mysql_query nicht mehr unterstützt. mysqli_query muss eine connection mitübergeben werden
while ($row = mysqli_fetch_assoc($result)) {                                                // In PHP 7 wird mysql_fetch_assoc nicht mehr unterstützt
    echo '<div class="kachel">';
    echo '<div class="title">' . $row['title'] . '</div>';
    echo '<img src="img/filmplakate/' . $row["id"] . '.jpg"/><br/>';                        // In PHP werden Attribute mit einem $ gekennzeichnet und Anweisungen ; geschlossen
    echo '<div class="date">' . date("Y", strtotime($row['release_date'])) . '</div>';
    echo '</div>';
}                                                                                           // In PHP werden Code Blöcke mit } geschlossen



// Zeilenangaben aus dem originalen PHP Code (NICHT OBIGER PHP CODE): 

    // Zeile 1: HMTL Dokument wurde nicht deklariert
    // Zeile 1: HTML Root Element fehlt
    // Zeile 2: HTML Head fehlt: Style sollte im Head definiert werden
    // Zeile 1: HTML Body fehlt: HTML Code sollte im Body definiert werden

    // Zeile 31: Die Verwendung der Langform <?php ist zu empfehlen, da XML ebenso Processing Instruction Blöcke vewendet
    // Zeile 32: Sofern connect.inc.php bereits eine Verbindung zur Datenbank aufgebaut hat, können untere SQL Statements erfolgen
    // Zeile 33: In PHP 7 muss die connection aus dem connect.inc.php global definiert werden, da sie später für sqli Methoden benötigt wird
    // Zeile 34: Attribut release_date fehlt im SELECT und Attribut title hat einen Tippfehler im ORDER BY
    // Zeile 35: In PHP 7 wird mysql_query nicht mehr unterstützt. mysqli_query muss eine connection mitübergeben werden
    // Zeile 36: In PHP 7 wird mysql_fetch_assoc nicht mehr unterstützt
    // Zeile 40: In PHP werden Attribute mit einem $ gekennzeichnet und Anweisungen ; geschlossen
    // Zeile 43: In PHP werden Code Blöcke mit } geschlossen
?>

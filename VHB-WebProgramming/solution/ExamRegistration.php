<!DOCTYPE html>

<html>

<head>
    <title>Klausuranmeldung</title>

    <style>
        form {
            display: inline-block;
            margin: 0em;
            border: 2px solid black;
            padding: 1em;
        }

        form span,
        form label:not(.radio),
        form input:not(.radio) {
            display: block;
        }

        input:focus {
            outline-color: blue;
        }

        .error {
            display: block;
            color: red;
        }
    </style>
</head>

<?php
$error = array();

// Request Method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validation Vorname
    if (empty($_POST["vorname"])) {
        $error["vorname"] = "Ungültiger Vorname!";
    }

    // Validation Nachname
    if (empty($_POST["nachname"])) {
        $error["nachname"] = "Ungültiger Nachname!";
    }

    // Validation Matrikelnummer
    if (empty($_POST["matrikelnummer"]) or !preg_match("/^[0-9]{7}$/", $_POST["matrikelnummer"])) {
        $error["matrikelnummer"] = "Ungültige Matrikelnummer!";
    }

    // Validation Phone
    if (empty($_POST["phone"]) or !preg_match("/^\+49[\d\s]+$/", $_POST["phone"])) {
        $error["phone"] = "Ungültige Telefonnummer!";
    }

    // Validation Email
    if (empty($_POST["email"]) or !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error["email"] = "Ungültige Email!";
    }

    // Validation Geburtsdatum
    if (empty($_POST["geburtsdatum"])) {
        $error["geburtsdatum"] = "Ungültiges Geburtsdatum!";
    } elseif (strtotime("+ 18 year", strtotime($_POST["geburtsdatum"])) > time()) {
        $error["geburtsdatum"] = "Keine 18 Jahre!";
    }

    // Validation Studiengang
    if (empty($_POST["studiengang"])) {
        $error["studiengang"] = "Ungültiger Studiengang!";
    }

    // Validation Klausur
    if (empty($_POST["klausur"])) {
        $error["klausur"] = "Ungültige Klausur!";
    }
}

// set input value
function set_value($key)
{
    $value = !empty($_POST[$key]) ? $_POST[$key] : "";
    echo "value=\"" . $value . "\"";
}

// set input check
function set_check($key)
{
    $check = !empty($_POST["studiengang"][$key]) ? "checked" : "";
    echo $check;
}

// set input select
function set_select($key)
{
    if (!empty($_POST["klausur"])) {
        $select = in_array($key, $_POST["klausur"]) ? "selected" : "";
        echo $select;
    }
}
?>


<body>
    <form name="ExamRegistration" action="ExamRegistration.php" method="POST" novalidate>

        <!-- Vorname -->
        <label for="vorname">Vorname</label>
        <input type="text" id="vorname" name="vorname" placeholder="Vorname" <?php set_value("vorname") ?> autofocus>

        <!-- Nachname -->
        <label for="nachname">Nachname</label>
        <input type="text" id="nachname" name="nachname" placeholder="Nachname" <?php set_value("nachname") ?>>

        <!-- Matrikelnummer -->
        <label for="matrikelnummer">Matrikelnummer</label>
        <input type="number" id="matrikelnummer" name="matrikelnummer" placeholder="Matrikelnummer" <?php set_value("matrikelnummer") ?>>

        <!-- Phone -->
        <label for="phone">Phone</label>
        <input type="phone" id="phone" name="phone" placeholder="Phone" <?php set_value("phone") ?>>

        <!-- Email -->
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" <?php set_value("email") ?>>

        <!-- Geburtsdatum -->
        <label for="geburtsdatum">Geburtsdatum</label>
        <input type="date" id="geburtsdatum" name="geburtsdatum" <?php set_value("geburtsdatum") ?>>

        <!-- Studiengang -->
        <span>Studiengang</span>
        <input class="radio" type="radio" id="1" name="studiengang" value="1" <?php set_check("1") ?>> <label class="radio" for="1">Wirtschaftsinformatik</label> <br>
        <input class="radio" type="radio" id="2" name="studiengang" value="2" <?php set_check("2") ?>> <label class="radio" for="2">Wirtschaftswissenschaften</label> <br>

        <!-- Klausur -->
        <label for="klausur">Klausur</label>
        <select id="klausur" name="klausur[]" size="3" multiple>
            <option value="1" <?php set_select("1") ?>>Web-Programming</option>
            <option value="2" <?php set_select("2") ?>>E-Wiinf</option>
            <option value="3" <?php set_select("3") ?>>Logistik 1</option>
        </select>

        <!-- Anmerkung -->
        <label for="anmerkung">Weitere Anmerkung</label>
        <textarea id="anmerkung" name="anmerkung"></textarea>

        <!-- Submit Button -->
        <input type="submit">

    </form>

    <?php
    if (count($error) >= 1) {
        foreach ($error as $error_item) {
            echo "<p class=\"error\">$error_item</p>";
        }
    }
    ?>
</body>

</html>
<!DOCTYPE html>

<html>

<head>
    <title>Body Mass Index</title>
    <style>
        form {
            display: inline-block;
            margin: 0em;
            border: 2px solid black;
            padding: 1em;
        }

        form>label,
        form>input {
            display: block;
        }

        form>input:focus {
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

$bmi = 0;
$bmi_color = "";

// Request Method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validation Height
    if (empty($_POST["height"]) or $_POST["height"] < 0) {
        $error["height"] = "Invalid body height!";
    }

    // Validation Weight
    if (empty($_POST["weight"]) or $_POST["weight"] < 0) {
        $error["weight"] = "Invalid body weight!";
    }

    // Print BMI
    if (count($error) == 0) {
        $bmi = bmi_calculation($_POST["height"], $_POST["weight"]);
        bmi_color($bmi);
    }
}

// BMI Calculation
function bmi_calculation($height, $weight)
{
    $bmi = $weight / (($height / 100) ** 2);    // calculate bmi with height and weight
    $bmi = round($bmi, 1);                      // round bmi to one decimal place
    return $bmi;
}
// BMI Color Format
function bmi_color($bmi)
{
    global $bmi_color;
    if ($bmi <= 18.5) {
        $bmi_color = "blue";
    } elseif (($bmi > 18.5) && ($bmi <= 25.0)) {
        $bmi_color = "green";
    } elseif (($bmi > 25.0) && ($bmi <= 30.0)) {
        $bmi_color = "yellow";
    } else {
        $bmi_color = "red";
    }
}
?>

<body>

    <!-- Body Mass Index Formular-->
    <form name="BodyMassIndex" action="BodyMassIndex.php" method="POST" novalidate>

        <!-- Height -->
        <label for="height">Height in cm</label>
        <input type="number" id="height" name="height" placeholder="height" min="0" value="<?php echo $_POST["height"]; ?>" autofocus required>

        <!-- Weight -->
        <label for="weight">Weight in kg</label>
        <input type="number" id="weight" name="weight" placeholder="weight" min="0" value="<?php echo $_POST["weight"]; ?>" required>

        <!-- Submit Button -->
        <input type="submit">

    </form>

    <?php
    if ($bmi != 0) {
        echo "<p class=\"bmi\" style=\"color: $bmi_color\">Your BMI is $bmi </p>";
    } elseif (count($error) >= 1) {
        foreach ($error as $error_item) {
            echo "<p class=\"error\">$error_item</p>";
        }
    }
    ?>
</body>

</html>
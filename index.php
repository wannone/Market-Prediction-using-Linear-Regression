<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Prediction</title>
    <style>
        label, input {
            display: block;
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h2>Market Prediction Inputs</h2>

        <div id="dayInputs">
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<label for='day$i'>Input for Day $i:</label>";
                echo "<input type='number' id='day$i' name='day$i' value='" . (isset($_POST["day$i"]) ? $_POST["day$i"] : '') . "' required>";
            }
            ?>
        </div>

        <label for="predictday">Prediction for Day:</label>
        <input type="number" id="predictday" name="predictday" min="11" required value="<?php echo isset($_POST['predictday']) ? $_POST['predictday'] : ''; ?>">

        <button type="submit" name="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $x = [];
        $y = [];

        for ($i = 1; $i <= 10; $i++) {
            $x[$i] = $i;
            $y[$i] = $_POST["day{$i}"];
        }

        $nday = $_POST["predictday"];
        
        $x_total = array_sum($x);
        $y_total = array_sum($y);

        $xy = 0;
        $x2 = 0;

        for ($i = 1; $i <= 10; $i++) {
            $xy += ($x[$i] * $y[$i]);
            $x2 += ($x[$i] * $x[$i]);
        }

        $n = count($x);

        $m = ($n * $xy - $x_total * $y_total) / ($n * $x2 - $x_total * $x_total);

        $y_mean = $y_total / $n;
        $x_mean = $x_total / $n;

        $c = $y_mean - ($m * $x_mean);

        $predictedValue = $m * $nday + $c;


        echo "<h3>Predicted Value for Day $nday: " . round($predictedValue, 2) . "</h3>";
    }
    ?>
</body>
</html>
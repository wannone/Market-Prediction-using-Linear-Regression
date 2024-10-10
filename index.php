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

        // $changePercentage = [];
        // for ($i = 1; $i < 10; $i++) {
        //     $change[$i] = round((($y[$i + 1] - $y[$i]) / $y[$i]) * 100, 2);
        // }

        
        // // for ($i = 1; $i < 10; $i++) {
        // //     echo "<li>Day $i to Day ". $change[$i];
        // // }

        // $averageChange = array_sum($change) / count($change);

        // $predictedValue = $y[10];

        // for ($i = 11; $i <= $nday; $i++) {
        // $predictedValue += $predictedValue * ($averageChange / 100);
        // }

        // echo "<h3>Predicted Value for Day $nday: " . round($predictedValue, 2) . "</h3>";

        
        $x_total = array_sum($x);
        $y_total = array_sum($y);

        $xy = 0;
        $x2 = 0;
        //$y2 = 0;

        for ($i = 1; $i <= 10; $i++) {
            $xy += ($x[$i] * $y[$i]);
            $x2 += ($x[$i] * $x[$i]);
            //$y2 += ($y[$i] * $y[$i]);
        }
        echo"xy: $xy    ";

        $n = count($x);

        //$m = ((10 * $xy) - ($x_total - $y_total)) / ((10 * $x2) - ($x_total * $x_total));
        $m = ($n * $xy - $x_total * $y_total) / ($n * $x2 - $x_total * $x_total);
        echo"m = $m    ";

        $y_mean = $y_total / $n;
        $x_mean = $x_total / $n;

        $c = $y_mean - ($m * $x_mean);
        echo"c = $c   ";

        $predictedValue = $m * $nday + $c;


        echo "<h3>Predicted Value for Day $nday: " . round($predictedValue, 2) . "</h3>";
    }
    ?>
</body>
</html>
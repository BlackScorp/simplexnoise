<?php
declare(strict_types=1);
error_reporting(E_ALL);
$gradients = glob(__DIR__ . '/gradients/*.png');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: auto;
        }

        iframe[name="map"] {
            border: 0;
            width: 100%;
            height: 100%;
            position: absolute;

            margin: 0 auto;
        }
    </style>
</head>
<body>
<h1>Simplex Noise Preview</h1>
<form method="GET" action="generate.php" target="map">
    <div><label for="x">X:</label> <input type="text" id="x" name="x" value="<?= $_GET['x'] ?? 0 ?>">
        <small>Move map to the left</small>
    </div>
    <div><label for="y">Y :</label> <input type="text" id="y" name="y" value="<?= $_GET['y'] ?? 0 ?>">
        <small>Move map to the top</small>
    </div>
    <div><label for="w">Width:</label> <input type="text" id="w" name="w" value="<?= $_GET['w'] ?? 100 ?>">
        <small>Width of map in pixel</small>
    </div>

    <div><label for="h">Height:</label> <input type="text" id="h" name="h" value="<?= $_GET['h'] ?? 100 ?>">
        <small>Height of map in pixel</small>
    </div>
    <div><label for="scale">Scale:</label> <input type="text" id="scale" name="scale"
                                                  value="<?= $_GET['scale'] ?? 5 ?>">
        <small>Scale the map X times for the output</small>
    </div>
    <div><label for="zoom">Zoom:</label> <input type="text" id="zoom" name="zoom" value="<?= $_GET['zoom'] ?? 0.025 ?>">
        <small>show a region of subpixel</small>
    </div>
    <div><label for="octaves">Octaves:</label> <input type="text" id="octaves" name="octaves"
                                                      value="<?= $_GET['octaves'] ?? 4 ?>">
        <small>Repeated interpolations, lager number = slower generation but more details</small>
    </div>
    <div><label for="zoom">Frequency:</label> <input type="text" id="frequency" name="frequency"
                                                     value="<?= $_GET['frequency'] ?? 2.0 ?>">
        <small>Bumpiness of the map</small>
    </div>
    <div><label for="zoom">Amplitude:</label> <input type="text" id="amplitude" name="amplitude"
                                                     value="<?= $_GET['amplitude'] ?? 0.5 ?>">
        <small>Heigh of the map, higher number= more white pixels, lower number = more black pixels</small>
    </div>
    <div>


        <?php
        foreach ($gradients as $gradient):
            $value = basename($gradient);
            $isSelected = $_GET['gradient'] ?? 'greyscale.png' === $value;
            ?>
            <div><input type="radio" name="gradient" value="<?= $value ?>" <?= $isSelected ? "checked" : "" ?>><img
                        src="gradients/<?= $value ?>"></div>
        <?php
        endforeach; ?>


    </div>
    <div>
        <button>Generate</button>
    </div>
</form>
<hr>

<iframe name="map" src="generate.php"></iframe>


</body>
</html>

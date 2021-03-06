<?php

declare(strict_types=1);
error_reporting(-1);
require_once __DIR__ . '/../vendor/autoload.php';

$mapWidth = $_GET['w'] ?? 100;
$mapHeight = $_GET['h'] ?? 100;
$offsetX = $_GET['x'] ?? 0;
$offsetY = $_GET['y'] ?? 0;
$scale = $_GET['scale'] ?? 5;
$zoom = $_GET['zoom'] ?? 0.025;
$octaves = $_GET['octaves'] ?? 4;
$persistence = $_GET['persistence'] ?? 0.5;
$elevation = $_GET['elevation'] ?? 1.0;
$gradient = $_GET['gradient'] ?? 'greyscale.png';

$gradient = imagecreatefrompng(__DIR__ . '/gradients/' . $gradient);

$colors = [];

for ($i = 0; $i < 256; $i++) {
    $colors[] = imagecolorat($gradient, $i, 1);
}


$displayWidth = $mapWidth * $scale;
$displayHeight = $mapHeight * $scale;


$noiseImage = imagecreatetruecolor((int)$mapWidth, (int)$mapHeight);
$displayImage = imagecreatetruecolor($displayWidth, $displayHeight);

$noise2D = new \BlackScorp\SimplexNoise\Noise2D(
    (float)$zoom,
    (int)$octaves,
    (float)$persistence,
    (float)$elevation
);

for ($x = 0; $x < $mapWidth; $x++) {
    for ($y = 0; $y < $mapHeight; $y++) {
        $locationX = $offsetX + $x;
        $locationY = $offsetY + $y;
        $greyValue = $noise2D->getGreyValue($locationX, $locationY);
        $color = $colors[$greyValue];
        imagesetpixel($noiseImage, $x, $y, $color);
    }
}


imagecopyresampled(
    $displayImage,
    $noiseImage,
    0,
    0,
    0,
    0,
    $displayWidth,
    $displayHeight,
    (int)$mapWidth,
    (int)$mapHeight
);


header('Content-Type:image/png');
imagepng($displayImage);
imagedestroy($displayImage);
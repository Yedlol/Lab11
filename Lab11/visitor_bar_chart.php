<?php
header("Content-type: image/png");

// Create image
$width = 600;
$height = 400;
$image = imagecreate($width, $height);

// Colors
$white = imagecolorallocate($image, 255, 255, 255);
$blue = imagecolorallocate($image, 0, 0, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Data: Table 1 (2011)
$data = [
    "Shopping" => 13149,
    "Transport" => 10019,
    "Food" => 9691,
    "Accommodation" => 5028,
    "Before Trip" => 1097,
    "Other" => 3362
];

$maxValue = max($data);
$barWidth = 40;
$spacing = 20;
$x = 50;
$y_base = 350;

// Draw axes
imageline($image, 40, 20, 40, $y_base, $black);
imageline($image, 40, $y_base, $width - 20, $y_base, $black);

// Draw bars
foreach ($data as $label => $value) {
    $barHeight = ($value / $maxValue) * 300;
    imagefilledrectangle($image, $x, $y_base - $barHeight, $x + $barWidth, $y_base, $blue);
    imagestringup($image, 2, $x + 5, $y_base + 50, $label, $black);
    $x += $barWidth + $spacing;
}

imagepng($image);
imagedestroy($image);
?>

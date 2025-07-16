<?php
header("Content-type: image/png");

// Table 2: Domestic Tourists 2011
$data = [
    "Food & beverages" => 7756,
    "Transport" => 7417,
    "Accommodation" => 4985,
    "Shopping" => 3801,
    "Before trip" => 801,
    "Other activities" => 2249
];

$total = array_sum($data);

// Create canvas
$image = imagecreatetruecolor(600, 500);
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// Slice colors
$colors = [
    imagecolorallocate($image, 255, 99, 132),
    imagecolorallocate($image, 54, 162, 235),
    imagecolorallocate($image, 255, 206, 86),
    imagecolorallocate($image, 75, 192, 192),
    imagecolorallocate($image, 153, 102, 255),
    imagecolorallocate($image, 255, 159, 64)
];

// Draw pie chart
$centerX = 250;
$centerY = 250;
$width = 300;
$height = 300;
$startAngle = 0;
$i = 0;

foreach ($data as $label => $value) {
    $angle = ($value / $total) * 360;
    $endAngle = $startAngle + $angle;

    // Draw the arc slice
    imagefilledarc($image, $centerX, $centerY, $width, $height, $startAngle, $endAngle, $colors[$i], IMG_ARC_PIE);

    // Calculate label position
    $midAngle = deg2rad(($startAngle + $endAngle) / 2);
    $labelX = $centerX + cos($midAngle) * 180;
    $labelY = $centerY + sin($midAngle) * 100;

    // Add label text
    $percent = round(($value / $total) * 100, 1);
    $labelText = "$label\n($percent%)";
    imagestring($image, 2, $labelX - 30, $labelY - 10, $labelText, imagecolorallocate($image, 0, 0, 0));

    $startAngle += $angle;
    $i++;
}

// Output image
imagepng($image);
imagedestroy($image);
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "lab11");
$sql = "SELECT component, year2011 FROM expenditure_visitors";
$result = mysqli_query($conn, $sql);

// Prepare data array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['component']] = $row['year2011'];
}

// Image settings
header("Content-type: image/png");
$image = imagecreate(600, 400);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);

$maxValue = max($data);
$barWidth = 40;
$spacing = 20;
$x = 50;
$y_base = 350;

imageline($image, 40, 20, 40, $y_base, $black);
imageline($image, 40, $y_base, 580, $y_base, $black);

foreach ($data as $label => $value) {
    $barHeight = ($value / $maxValue) * 300;
    imagefilledrectangle($image, $x, $y_base - $barHeight, $x + $barWidth, $y_base, $blue);
    imagestringup($image, 2, $x + 5, $y_base + 50, $label, $black);
    $x += $barWidth + $spacing;
}

imagepng($image);
imagedestroy($image);
?>

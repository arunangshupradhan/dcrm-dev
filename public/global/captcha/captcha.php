<?php
$string_length = 6;
$captcha_string =  $_REQUEST['captcha'];
$image = imagecreatetruecolor(175, 40);
imageantialias($image, true);
$colors = [];
$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);
for($i = 0; $i < 5; $i++) {
	$colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}
imagefill($image, 0, 0, $colors[0]);
for($i = 0; $i < 10; $i++) {
	imagesetthickness($image, rand(2, 10));
	$rect_color = $colors[rand(1, 4)];
	imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
}
$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];
define('PATH', dirname(__FILE__));
// $fonts = ['assets\fonts\captcha\Acme.ttf', 'assets\fonts\captcha\Ubuntu.ttf', 'assets\fonts\captcha\Merriweather.ttf', 'assets\fonts\captcha\PlayfairDisplay.ttf'];

$fonts = [PATH.'/font/Acme.ttf', PATH.'/font/Ubuntu.ttf', PATH.'/font/Merriweather.ttf', PATH.'/font/PlayfairDisplay.ttf'];
for($i = 0; $i < $string_length; $i++) {
	$letter_space = round(170/$string_length);
	$initial = 10;
	imagettftext($image, 20, rand(-15, 15), $initial + $i*$letter_space, 30, $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
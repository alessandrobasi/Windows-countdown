<?php

header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
date_default_timezone_set(Europe/Rome);
ini_set("display_errors", "1");
error_reporting(E_ALL);

$now = date_create( 'now' );

// Windows 7 SP1: 14 genn 2020
$win7sp1 = date_create( '2020-01-14' );
$interval1 = date_diff( $win7sp1, $now );
$countdown_win7 = $interval1->format('%a days left');

// Windows 8.1: 10 genn 2023
$win8_1 = date_create( '2023-01-10' );
$interval2 = date_diff( $win8_1 , $now );
$countdown_win8_1 = $interval2->format('%a days left');


//creazione img
$immagine=imagecreatetruecolor(1080,420);

//trasparenza
imagealphablending($immagine, false);
$transparency = imagecolorallocatealpha($immagine, 255, 255, 255, 0); //127
imagefill($immagine, 0, 0, $transparency);
imagesavealpha($immagine, true);

//font
putenv('GDFONTPATH=' . realpath('.'));
$font1 = "arial.ttf";

//colore
$nero = imagecolorallocate($immagine, 0, 0, 0);
$rosso = imagecolorallocate($immagine, 255, 0, 0);

//testi
if($interval1->invert != 0){
imagettftext($immagine, 50, 0, 10, 60, $nero, $font1, "Windows 7 SP1 eol: ".$countdown_win7 );
}
else{
imagettftext($immagine, 50, 0, 10, 60, $rosso, $font1, "Windows 7 SP1 eol: -".$countdown_win7 );
}

if($interval2->invert != 0){
imagettftext($immagine, 50, 0, 10, 140, $nero, $font1, "Windows 8.1 eol: ".$countdown_win8_1 );
}
else{
imagettftext($immagine, 50, 0, 10, 140, $rosso, $font1, "Windows 8.1 eol: -".$countdown_win8_1 );
}

imagettftext($immagine, 15, 0, 10, 400, $nero, $font1, "eol: End of Life" );
imagettftext($immagine, 15, 0, 890, 400, $nero, $font1, "By alessandrobasi.it" );

header('content-type: image/png');

imagepng($immagine);
imagedestroy($immagine);
?>

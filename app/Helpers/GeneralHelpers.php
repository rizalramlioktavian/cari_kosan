<?php

// Helper Picture
if (!function_exists('makePicture')) {
    function makePicture($fontPath, $dest, $char)
    {
        $path = $dest;
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        imagettftext($image, 100, 0, 55, 150, $textcolor, $fontPath, $char);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
}

// Format Rupiah
if (!function_exists('rupiahFormat')) {
    function rupiahFormat($str)
    {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}

// Format Tanggal
if (!function_exists('dateFormat')) {
    function dateFormat($tanggal)
    {
        $value = Carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('l, d F Y');
    }
}

// Format Tanggal Back End (Admin)
if (!function_exists('dateFormatBack')) {
    function dateFormatBack($tanggal, $jam = null)
    {
        $value = Carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');

        if ($jam) {
            return $parse->translatedFormat('l, d F Y, ' . $jam);
        } else {
            return $parse->translatedFormat('l, d F Y, H:i');
        }
    }
}

// Format Tanggal Front End (User)
if (!function_exists('dateFormatFront')) {
    function dateFormatFront($tanggal, $jam = null)
    {
        $value = Carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');

        if ($jam) {
            return $parse->translatedFormat('d/m/Y, ' . $jam);
        } else {
            return $parse->translatedFormat('d/m/Y, H:i');
        }
    }
}

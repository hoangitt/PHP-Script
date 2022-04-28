<?php

$imagesDirectory = '04/';
// Source image directory, loop through each Image and resize it.
if ($dir = opendir($imagesDirectory)) {
    while (($file = readdir($dir)) !== false) {
        $imagePath = $imagesDirectory . $file;
        $checkValidImage = @getimagesize($imagePath);
        $image_name = basename($file);
        $regex = '/([^-](\d+)x(\d+)\.((?:png|jpeg|jpg|gif|bmp)))/';
        //image exists, is valid & larger than X
        if (file_exists($imagePath) && $checkValidImage && preg_match($regex, $image_name, $matches)) {
            unlink($imagePath);
            echo $image_name . ' removed' . PHP_EOL;
        }
    }
    closedir($dir);
}
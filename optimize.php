<?php

$imagesDirectory = 'gallery/'; //Source directory
$destinationDirectory = 'compressed/'; //Destination directory
$maxImageWidth = 500;
$maxImageHeight = 1000;
$quality = 80;

require_once 'vendor/autoload.php';

use PHPImageWorkshop\ImageWorkshop;

// Source image directory, loop through each Image and resize it.
if ($dir = opendir($imagesDirectory)) {
    while (($file = readdir($dir)) !== false) {
        $imagePath = $imagesDirectory . $file;
        $destPath = $destinationDirectory . $file;
        $checkValidImage = @getimagesize($imagePath);
        $image_name = basename($file);
        //image exists, is valid & larger than X
        if (file_exists($imagePath) && $checkValidImage) { //file size check (filesize($imagePath) > 800000)
            $layer = ImageWorkshop::initFromPath($imagePath);
            $layer->resizeInPixel($maxImageWidth, null, true);
            try {
//                $image = $layer->getResult();
//                echo "<pre>";
//                print_r($image);
//                echo "</pre>";
//                exit();
                //save to folder
                $layer->save($destinationDirectory, $file, true, null, 95);
                echo $file . ' resized' . PHP_EOL;
            } catch (Exception $ex) {
                echo $ex->getMessage() . PHP_EOL;
            }
        }
    }
    closedir($dir);
}
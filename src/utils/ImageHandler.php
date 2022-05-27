<?php 

namespace src\utils;

class ImageHandler {

    public function getSingleImage($imageName, $folderName) {
        if(!$_FILES[$imageName]['tmp_name']) {
            return;
        }

        $imagePath = $this->getImagePath($_FILES[$imageName]['name'], $folderName);

        if(!is_dir($imagePath)) {
            mkdir(dirname($imagePath));

            if(move_uploaded_file($_FILES[$imageName]['tmp_name'], $imagePath)) {
                return $imagePath;
            }
        }
    }

    public function getMultipleImage($imageName, $folderName) {
        $images = [];
        $allImagePaths = [];
        //return an array of image paths here
        if($_FILES[$imageName]) {
            foreach($_FILES[$imageName]['name'] as $key => $value ) {
                $images[$_FILES[$imageName]['tmp_name'][$key]] = $value;
            }
        }

        foreach($images as $tmp => $name) {
            $imagePath = $this->getImagePath($name, $folderName);
            if(!is_dir($imagePath)) {
                mkdir(dirname($imagePath));

                move_uploaded_file($tmp, $imagePath);
                $allImagePaths[] = $imagePath;
            }
        }

        return $allImagePaths;
    }

    public function deleteImage($imageName) {
        if(file_exists($imageName) and unlink($imageName)) {
            return true;
        }
    }

    private function getImagePath($imageName, $folderName) {

        $folder = $this->getRandomName();
 
         if(!is_dir("assets/images/$folderName")) {
             mkdir("assets/images/$folderName");
         }
         return "assets/images/$folderName".'/'.$folder.'/'.$imageName;
     }

    private function getRandomName($imageLength = 11) {
        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $folder = '';

        for($i = 0; $i < $imageLength; $i++) {
            $index = rand(0, strlen($chars) - 1);
            $folder .= $chars[$index]; 
        }
        return $folder;
    }
}
<?php

$tmpLoction = 'assets/upload';
if ($_FILES["files"]){
    if (!file_exists('../'.$tmpLoction)) {
        mkdir('../'.$tmpLoction);
    }
    $test = explode('.', $_FILES["files"]["name"]);
    $ext = end($test);
    $name = $_FILES["files"]["name"];

    $location = '../'.$tmpLoction.'/' . $name;
    $path = $tmpLoction.'/' . $name;

    if ($ext == 'pdf') {
        move_uploaded_file($_FILES["files"]["tmp_name"], $location);
    } else {
        $imageCompress = compressImage($_FILES["files"]["tmp_name"], $location, 60);
        move_uploaded_file($imageCompress, $location);
    }

    $data = array(
        "Extention" => $ext,
        "Name" => $_FILES["files"]["name"],
        "Destination" => $location
    );
}

function compressImage($source, $destination, $quality){
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    return imagejpeg($image, $destination, $quality);
}

?>
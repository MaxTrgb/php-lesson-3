<?php
session_start();
function dump($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function redirect($page)
{
    header("Location: index.php?page=$page");
    exit;
}

define("BASE_FOLDER", "folders/");


function createFolder($folderName)
{
    $folderPath = BASE_FOLDER . $folderName;
    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
        return "Folder '$folderName' created successfully inside 'folders'.";
    } else {
        return "Folder '$folderName' already exists inside 'folders'.";
    }
}


function deleteFolder($folderName)
{
    $folderPath = BASE_FOLDER . $folderName;
    if (is_dir($folderPath)) {
        rmdir($folderPath);
        return "Folder '$folderName' deleted successfully from 'folders'.";
    } else {
        return "Folder '$folderName' does not exist inside 'folders'.";
    }
}


function uploadImage($folderName, $file)
{
    $targetDir = BASE_FOLDER . $folderName . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }


    if ($file["size"] > 5000000) {
        return "File is too large.";
    }


    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        return "Only JPG, JPEG, PNG & GIF files are allowed.";
    }


    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return "The file " . basename($file["name"]) . " has been uploaded to '$folderName' inside 'folders'.";
    } else {
        return "There was an error uploading the file.";
    }
}
?>
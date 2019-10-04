<?php
include '../functions.php';

$file = $_GET['nama_file'];

$fileDir = '../uploads/'.$file;

if(!file_exists($fileDir)){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($fileDir);
}
 
?>
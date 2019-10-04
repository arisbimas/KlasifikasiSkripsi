<?php
// Database configuration
include '../db/koneksi.php';
include '../functions.php';
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$fileSize = basename($_FILES["file"]["size"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('pdf','docx');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
            //checking if file exsists
        if(file_exists("$targetFilePath")) unlink("$targetFilePath");
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>
<!--     // ambil data file
$namaFile = $_FILES['file_data']['name'];
$namaSementara = $_FILES['file_data']['tmp_name'];

// tentukan lokasi file akan dipindahkan
$dirUpload = "../uploads/";

// pindahkan file
$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

if ($terupload) {
    echo "Upload berhasil!<br/>";
    echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
} else {
    echo "Upload Gagal!";
} -->
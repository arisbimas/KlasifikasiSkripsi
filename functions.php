<?php 

// Koneksi DB
$conn = mysqli_connect("localhost","root","","bagas_db");

// Query
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query); //ini query sqlnya
	$rows = []; //ini wadah kosong untuk menampung hasil query sql
	while ($row = mysqli_fetch_assoc($result)) { //ketika ambil data menggunakan looping
		//row adalah baju yang di ambil setiap loopingnya
		$rows[]= $row; //rows di isi dengan hasil ambilannya
	}
	return $rows;	
}

// Tambah Skripsi
function tambahSkripsi ($data)
{
	global $conn;	
	$judul_skripsi = $data['judul_skripsi'];
	$nama_mhs = $data['nama_mhs'];
	$npm_mhs = $data['npm_mhs'];
	$klasifikasi = $data['klasifikasi'];
	$tahun = $data['tahun'];

	//upload file dulu
	$file = uploadFile($nama_mhs,$npm_mhs);
	if (!$file) {
		return false;
	}

	$query2 = "INSERT INTO tb_skripsi (judul_skripsi,nama_mhs,npm_mhs,klasifikasi,tahun, nama_file, tgl_upload) VALUES ('$judul_skripsi', '$nama_mhs', '$npm_mhs', '$klasifikasi', '$tahun', '$file', NOW())";

	$hasil2 = mysqli_query($conn, $query2);
	return mysqli_affected_rows($conn); 

}

//Upload FIle
function uploadFile($nama_mhs,$npm_mhs)
{
	global $conn;	

	//file
	$fileName = basename($_FILES["file_data"]["name"]);
	$fileSize = basename($_FILES["file_data"]["size"]);
	$tmpName = basename($_FILES["file_data"]["tmp_name"]);
	$targetDir = "../uploads/";
	$allowTypes = array('pdf','docx');

	$idFile = $nama_mhs; 
	$idFileBaru = $idFile.$npm_mhs;
	$idFileBaruEx = str_replace(' ','',$idFileBaru);
	$ekstensiFile = explode('.', $fileName);
	$ekstensiFile = strtolower(end($ekstensiFile));
	$fileNameNew = $idFileBaruEx.'.'.$ekstensiFile;
	$targetFilePath = $targetDir . $fileNameNew;

	//cek ekstensi
	if (!in_array($ekstensiFile, $allowTypes)) {
		echo "<script type='text/javascript'>
                alert('Tipe File Salah!');
              </script>";
        return false;
	}

	//cek ukuran file
	if ($fileSize > 8000000) {
		echo "<script type='text/javascript'>
                alert('Ukuran File Terlalu Besar!');
              </script>";
        return false;
	}

	//simpan file ke folder upload
	if (!move_uploaded_file($_FILES["file_data"]["tmp_name"], $targetFilePath)) {
		return false;
	}

	return $fileNameNew;   
}

// edit S
function editSkripsi($data){
	global $conn;
	$id 			= $_GET['id'];
	$nama_mhs 		= $data['nama_mhs'];
	$judul_skripsi 	= $data['judul_skripsi'];
	$npm_mhs 		= $data['npm_mhs'];
	$klasifikasi 	= $data['klasifikasi'];
	$tahun			= $data['tahun'];

	$file = uploadFile($nama_mhs,$npm_mhs);
	if (!$file) {
		return false;
	}

	//query update data
	$query = "UPDATE tb_skripsi SET
				judul_skripsi	= '$judul_skripsi',
				nama_mhs		= '$nama_mhs',
				npm_mhs	 		= '$npm_mhs',
				klasifikasi 	= '$klasifikasi',
				tahun 			= '$tahun',
				nama_file 		= '$file',
				tgl_upload 		= NOW()
				WHERE id = '$id'
				";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapusSkripsi($id){
	global $conn;
	$id = $_GET['id'];
	mysqli_query($conn, "DELETE FROM tb_skripsi WHERE id= $id");
	return mysqli_affected_rows($conn);
}

// Tambah Skripsi
function tambahDataSet ($data)
{
	global $conn;	
	$judul_skripsi 	= $data['judul_skripsi'];
	$klasifikasi 	= $data['klasifikasi'];

	$query = "INSERT INTO tb_dataset (judul_skripsi,klasifikasi) VALUES ('$judul_skripsi', '$klasifikasi')";

	$hasil2 = mysqli_query($conn, $query);
	return mysqli_affected_rows($conn); 

}

// Tambah User
function tambahUser ($data)
{
	global $conn;	
	$username	= $data['username'];
	$password	= $data['password'];
	$email		= $data['email'];
	$level		= 'admin';
	$password	= md5($password);


	$query2 = "INSERT INTO tb_user (username,password,email,level) VALUES ('$username', '$password', '$email', '$level')";

	$hasil2 = mysqli_query($conn, $query2);
	return mysqli_affected_rows($conn); 

}

function hapusUser($id){
	global $conn;
	$id = $_GET['id'];
	mysqli_query($conn, "DELETE FROM tb_user WHERE id= $id");
	return mysqli_affected_rows($conn);
}


 ?>
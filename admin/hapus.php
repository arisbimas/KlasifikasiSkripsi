<?php 
	require '../functions.php';

	$id = $_GET["id"];

	if(hapusSkripsi($id) > 0){
		echo "
         <script type='text/javascript'>
          alert('Berhasil Hapus');
          window.location.replace('repository.php');
         </script>
        ";
	}else {
		echo "
            <script type='text/javascript'>
              alert('Gagal Hapus');
             </script>
            ";	
	}

 ?>
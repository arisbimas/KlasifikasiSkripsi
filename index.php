<?php
include 'functions.php';

//Adds one to the counter
mysqli_query($conn,"UPDATE tb_visitors SET counter = counter + 1");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Repository Skripsi Teknik Informatika</title>
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>SOKS</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.6 -->
	  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="assets/css/_all-skins.min.css">
	  <!-- Date Picker -->
	  <link rel="stylesheet" href="assets/datepicker/datepicker3.css"> 
	  <!-- Latest compiled and minified CSS -->
	  <link rel="stylesheet" type="text/css" href="assets/DataTables_3/datatables.min.css"/>
  
</head>
<body>
	<div class="navbar navbar-default ">
      <div class="container-fluid">
        <div class="navbar-header">

           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>

            <a href="#home" class="navbar-brand page-scroll text-blue"><b>Repository Skripsi Teknik Informatika</b></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php" class="active text-blue"><span class="glyphicon glyphicon-log-in"></span> Masuk</a></li>          
          </ul>
        </div>

      </div>
    </div>
	<div class="container">
		<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        	<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Repository Skripsi</b></h3>
              <div class="box-tools col-md-0">
              	<div class="input-group" >
              		<form action="" method="get">
              			<select class="form-control pull-right" type="submit" name="klasifikasi" class="form-control" onchange="this.form.submit()">
              				<option>Semua</option>
              				<?php 
              				$klasifikasi=mysqli_real_escape_string($conn,$_GET['klasifikasi']);
	              			if ($klasifikasi == "Analisis"){
	              				echo "<option selected>Analisis</option>
	              				<option>Rancang Bangun</option>
	              				<option>Jaringan</option>";
	              			} else if($klasifikasi == "Rancang Bangun"){
	              				echo "<option >Analisis</option>
	              				<option selected>Rancang Bangun</option>
	              				<option>Jaringan</option>";
	              			} else if($klasifikasi == "Jaringan"){
	              				echo "<option>Analisis</option>
	              				<option>Rancang Bangun</option>
	              				<option selected>Jaringan</option>";
	              			} else {
	              				echo "<option>Analisis</option>
	              				<option>Rancang Bangun</option>
	              				<option>Jaringan</option>";
	              			}?>	             
	              		</select>
	              	</form>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table class="table table-hover table-bordered" id="tablerepo-awal">
                <thead class="bg-primary">
                	<tr>
	                  <!-- <th>ID</th> -->
	                  <th class="text-center">NPM Mahasiswa</th>
	                  <th class="text-center">Nama Mahasiswa</th>
	                  <th class="text-center">Judul Skripsi</th>
	                  <th class="text-center">Klasifikasi</th>
	                  <th class="text-center">Tahun</th>
	                  <th class="text-center">Nama File</th>
	                  <th class="text-center">Aksi</th>
	                </tr>
	            </thead>

            	<?php $i = 1;
                if(isset($_GET['klasifikasi'])){
					$klasifikasi=mysqli_real_escape_string($conn,$_GET['klasifikasi']);
					$repo = mysqli_query($conn,"SELECT * from tb_skripsi where klasifikasi = '$klasifikasi' order by id desc");

					if($klasifikasi == 'Semua'){
                		$repo = mysqli_query($conn,"SELECT * FROM tb_skripsi");
					}

				} else{
            		$repo = mysqli_query($conn,"SELECT * FROM tb_skripsi");
				}

				$row=mysqli_fetch_array($repo);
				if ($row == "") {
					echo "<td colspan='7' class='text-center'><h1>Tidak Ada Data</h1></td>";
				}
             	?>
                <?php foreach ($repo as $repository) :?>
                <tbody>
	                <tr>
	                  <td><?= $repository['npm_mhs'] ?></td>
	                  <td><?= $repository['nama_mhs'] ?></td>
	                  <td><?= $repository['judul_skripsi'] ?></td>
	                  <td><?= $repository['klasifikasi'] ?></td>
	                  <td><?= $repository['tahun'] ?></td>
	                  <td><?= $repository['nama_file'] ?></td>
	                  <td>
	                  	<a href="admin/download.php?nama_file=<?= $repository['nama_file'] ?>" class="btn btn-success">Download</a>
	                  	
	                  </td>
	                </tr>
	                <?php $i++; ?>
		            <?php endforeach ?>
      	    	</tbody>
      		  </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
	</div>
</body>

<!-- jQuery 2.2.3 -->
<script src="assets/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- datepicker -->
<script src="assets/js/bootstrap-datepicker.js"></script>
<!-- Slimscroll -->
<script src="assets/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/app.min.js"></script>
 
<script type="text/javascript" src="assets/DataTables_3/datatables.min.js"></script>

<script type="text/javascript">
	$(document).ready( function () {
	    $('#tablerepo-awal').DataTable();
	});
</script>
</html>
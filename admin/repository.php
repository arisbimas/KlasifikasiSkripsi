<?php
include '../topmenu.php';
include '../sidebar.php';
include '../db/koneksi.php';
include '../functions.php'; 


?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        	<div class="box">
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

              <table class="table table-hover" id="tablerepo">
                <thead>
                	<tr>
	                  <th>No</th>
	                  <th>NPM Mahasiswa</th>
	                  <th>Nama Mahasiswa</th>
	                  <th>Judul Skripsi</th>
	                  <th>Klasifikasi</th>
	                  <th>Tahun</th>
	                  <th>Nama File</th>
	                  <th>Aksi</th>
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
				
                <tbody>
					<?php $i = 1; ?>
					<?php foreach ($repo as $repository) :?>
	                <tr>
					  <td><?= $i ?></td>
	                  <td><?= $repository['npm_mhs'] ?></td>
	                  <td><?= $repository['nama_mhs'] ?></td>
	                  <td><?= $repository['judul_skripsi'] ?></td>
	                  <td><?= $repository['klasifikasi'] ?></td>
	                  <td><?= $repository['tahun'] ?></td>
	                  <td><?= $repository['nama_file'] ?></td>
	                  <td>
	                  	<a href="download.php?nama_file=<?= $repository['nama_file'] ?>" class="btn btn-success">Download</a>
	                  	<a href="edit.php?id=<?= $repository['id'] ?>" class="btn btn-info">Edit</a>
	                  	<a  href="hapus.php?id=<?= $repository['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')">Delete</a>
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

    <!-- /.content -->
  </div> 
    
<?php
include '../footer.php';

?>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#tablerepo').DataTable();
	});
</script>
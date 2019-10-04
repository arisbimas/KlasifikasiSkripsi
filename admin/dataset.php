<?php
include '../topmenu.php';
include '../sidebar.php';
include '../functions.php'; 

$dataset = query("SELECT * from tb_dataset");

error_reporting(0);

  //cek apakah tombol submit udah di kilk blm
  if (isset($_POST["tambah"])) {

  	//cek apakah data berhasil  di tambah atau tidak
        if(tambahDataSet($_POST) > 0) {
          
          echo "
             <script type='text/javascript'>
              alert('Berhasil');
              window.location.replace('dataset.php');
             </script>
            ";

        }else {
          echo "
          <script type='text/javascript'>
            alert('Gagal');
           </script>
          ";      
        }
        
    }

  
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
              <h3 class="box-title"><b>Dataset</b></h3>
              <div class="box-tools col-md-0">
              	<a href="tambahdataset.php"  type="button"  class="btn btn-success" data-toggle="modal" data-target="#tambahdataset">Tambah Data Sets</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table class="table table-hover" id="tableds">
                <thead>
                	<tr>
	                  <th>No</th>
	                  <th>Judul Skripsi</th>
	                  <th>Klasifikasi</th>
	                </tr>
	            </thead>

                <tbody>
				<?php $i = 1; ?>            	
                <?php foreach ($dataset as $data) :?>
	                <tr>
	              	  <td><?= $i++ ?></td>
	                  <td><?= $data['judul_skripsi'] ?></td>
	                  <td><?= $data['klasifikasi'] ?></td>
	                </tr>
	            <?php endforeach ?>
                <?php $i++; ?>
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

<!-- The modal -->
<div class="modal fade" id="tambahdataset" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalLabel">Tambah Data Set</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST">
					<div class="form-group">
						<label for="judul_skripsi">Judul Skripsi</label>
						<input type="text" class="form-control" id="judul_skripsi" name="judul_skripsi">
					</div>
					<div class="form-group">
						<label for="klasifikasi">Klasifikasi</label>
						<input type="text" class="form-control" id="klasifikasi" name="klasifikasi">
					</div>
						<button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>
    
<?php
include '../footer.php';

?>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#tableds').DataTable();
	});
</script>
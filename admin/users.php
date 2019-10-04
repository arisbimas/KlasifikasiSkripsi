<?php
include '../topmenu.php';
include '../sidebar.php';
include '../functions.php'; 

$users = query("SELECT * from tb_user");

//cek apakah tombol submit udah di kilk blm
  if (isset($_POST["tambah"])) {

    $cekdatasama = mysqli_query($conn, "SELECT * from tb_user where username='".$_POST['username']."' ") or die(mysqli_error($conn));
    $count = mysqli_num_rows($cekdatasama);
      if($count == 0)
      {
        //cek apakah data berhasil  di tambah atau tidak
        if(tambahUser($_POST) > 0) {
          
          echo "
             <script type='text/javascript'>
              alert('Berhasil');
              window.location.replace('users.php');
             </script>
            ";

        }else {
          echo "
          <script type='text/javascript'>
            alert('Gagal');
           </script>
          ";      
        }

      } else {
        echo "
         <script type='text/javascript'>
          alert('Username sudah ada');
         </script>
        ";
      }
        
    }

  
?>

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
              <h3 class="box-title"><b>Users</b></h3>
              <div class="box-tools col-md-0">
                <a href="tambahuser.php" type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahuser">Tambah User</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table class="table table-hover" id="tableusers">
                <thead>
                	<tr>
	                  <th>No</th>
	                  <th>Nama User</th>
	                  <th>Email</th>
	                  <th>Role</th>
	                  <th>Aksi</th>
	                </tr>
	            </thead>

              <tbody>
			        <?php $i = 1; ?>            	
              <?php foreach ($users as $u) :?>
                <tr>
              	  <td><?= $i++ ?></td>
                  <td><?= $u['username'] ?></td>
                  <td><?= $u['email'] ?></td>
                  <td><?= $u['level'] ?></td>
                  <td>
                  	<a  href="hapususer.php?id=<?= $u['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</a>
                  </td>
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
<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalLabel">Tambah User</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password">
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
	    $('#tableusers').DataTable();
	});
</script>
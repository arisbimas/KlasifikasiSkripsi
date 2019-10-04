<?php
include '../topmenu.php';
include '../sidebar.php';
include '../db/koneksi.php';
include '../functions.php';

// error_reporting(0);  

  $id = $_GET['id'];

  $skripsi = query("SELECT * FROM tb_skripsi WHERE id = '$id'")[0];

  //cek apakah tombol submit udah di kilk blm
  if (isset($_POST["edit"])) {

    //cek apakah data berhasil  di tambah atau tidak
    if(editSkripsi($_POST) > 0 ) {
      
      echo "
         <script type='text/javascript'>
          alert('Berhasil Diedit');
          window.location.replace('repository.php');
         </script>
        ";

    }else {
      echo "
         <script type='text/javascript'>
          alert('Gagal Diedit'".mysqli_errno($conn).");
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
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Skripsi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <label for="judul">Judul Skrispi</label>
                <div class="form-group">
                  <div class="input-group input-group-md">
                    <input type="text" class="form-control" id="judul" placeholder="Masukan Judul"  name="judul_skripsi" value="<?php if (!empty($_POST["judul_skripsi"])) { echo $_POST["judul_skripsi"]; } else { echo $skripsi['judul_skripsi']; };  ?>" required>
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id="cek">CEK!</button>
                    </span>
                  </div>
                  
                </div>

                <div class="form-group">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input type="text" class="form-control" id="nama_mhs" placeholder="Masukan Nama Mahasiswa"  name="nama_mhs" value="<?php if (!empty($_POST["nama_mhs"])) { echo $_POST["nama_mhs"]; } else { echo $skripsi['nama_mhs']; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="npm_mhs">NPM Mahasiswa</label>
                  <input type="text" class="form-control" id="npm_mhs" placeholder="Masukan NPM Mahasiswa"  name="npm_mhs" value="<?php if (!empty($_POST["npm_mhs"])) { echo $_POST["npm_mhs"]; } else { echo $skripsi['npm_mhs']; };  
                  ?>" required>
                </div>

                <div class="form-group">
                  <label for="tahun">Tahun</label>
                  <input type="number" class="form-control" id="tahun" placeholder="Masukan Tahun"  name="tahun" value="<?php if (!empty($_POST["tahun"])) { echo $_POST["tahun"]; } else { echo $skripsi['tahun']; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="klasifikasi">Klasifikasi Skrispi</label>
                  <input type="text" class="form-control" id="klasifikasi" readonly  name="klasifikasi" value="<?php if (!empty($_POST["klasifikasi"])) { echo $_POST["klasifikasi"]; } else { echo $skripsi['klasifikasi']; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="file_data">File Skripsi (File tidak boleh lebih dari 8MB)</label>
                  <input type="file" id="file_data" name="file_data" class="btn btn-primary" required="">
                  <span></span>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
              </div>
            </form>
          </div>

          <!-- /.box -->
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
<script>
    $(document).ready(function() {
        $("#cek").click(function() {
            let judulskripsi = $("#judul").val().toLowerCase();
            let klasifikasi = $("#klasifikasi").val();

            console.log(judulskripsi)
            if(judulskripsi.match("rancang bangun")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("rancang bangun");
            } else if(judulskripsi.match("jaringan")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("jaringan");
            } else if(judulskripsi.match("game")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("game");
            }else if(judulskripsi.match("spk")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("spk");
            }else if(judulskripsi.match("analisis")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("analisis");
            }else if(judulskripsi.match("data mining")){
                $("#klasifikasi").val("");
                $("#klasifikasi").val("data mining");
            }
            else {
                $("#klasifikasi").val("");         }
        });
   });      
</script>
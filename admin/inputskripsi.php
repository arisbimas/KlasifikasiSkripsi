<?php
include '../topmenu.php';
include '../sidebar.php';
include '../db/koneksi.php';
include '../functions.php';

error_reporting(0);

  //cek apakah tombol submit udah di kilk blm
  if (isset($_POST["submit"])) {

    //cek npm yang sama
    $cekdatasama = mysqli_query($conn, "select * from tb_skripsi where npm_mhs='".$_POST['npm_mhs']."' ") or die(mysqli_error($conn));
    $count = mysqli_num_rows($cekdatasama);
      if($count == 0)
      {
        //cek apakah data berhasil  di tambah atau tidak
        if(tambahSkripsi($_POST) > 0) {
          
          echo "
             <script type='text/javascript'>
              alert('Berhasil');
              window.location.replace('inputskripsi.php');
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
          alert('NPM SAMA');
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
            <div class="box-header">
              <h3 class="box-title">Tambah Skripsi</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <?php
                    $q = "SELECT * from tb_dataset ";
                    $query = mysqli_query($conn,$q);
                    $count = mysqli_num_rows($query);
                   ?>
                  <input type="text" id ="jm_dataset" name="jm_dataset" class="form-control pull-right" value="<?=  $count; ?>">
                </div>
              </div>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <label for="judul">Judul Skrispi</label>
                <div class="form-group">
                  <div class="input-group input-group-md">
                    <input type="text" class="form-control" id="judul" placeholder="Masukan Judul"  name="judul_skripsi" value="<?php if (!empty($_POST["judul_skripsi"])) { echo $_POST["judul_skripsi"]; } else { echo ''; };  ?>" required>
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id="cek">CEK!</button>
                    </span>
                  </div>
                  
                </div>

                <div class="form-group">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input type="text" class="form-control" id="nama_mhs" placeholder="Masukan Nama Mahasiswa"  name="nama_mhs" value="<?php if (!empty($_POST["nama_mhs"])) { echo $_POST["nama_mhs"]; } else { echo ''; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="npm_mhs">NPM Mahasiswa</label>
                  <input type="text" class="form-control" id="npm_mhs" placeholder="Masukan NPM Mahasiswa"  name="npm_mhs" value="<?php if (!empty($_POST["npm_mhs"])) { echo $_POST["npm_mhs"]; } else { echo ''; };  
                  ?>" required>
                </div>

                <div class="form-group">
                  <label for="tahun">Tahun</label>
                  <input type="number" class="form-control" id="tahun" placeholder="Masukan Tahun"  name="tahun" value="<?php if (!empty($_POST["tahun"])) { echo $_POST["tahun"]; } else { echo ''; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="klasifikasi">Klasifikasi Skrispi</label>
                  <input type="text" class="form-control" id="klasifikasi" readonly  name="klasifikasi" value="<?php if (!empty($_POST["klasifikasi"])) { echo $_POST["klasifikasi"]; } else { echo ''; };  ?>" required>
                </div>

                <div class="form-group">
                  <label for="file_data">File Skripsi (File tidak boleh lebih dari 8MB)</label>
                  <input type="file" id="file_data" name="file_data" class="btn btn-primary" required="">
                  <span></span>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
            let jm_dataset = parseInt($("#jm_dataset").val());

            // var rancangbangun = [
            //     ['rancang bangun', 1],
            //     ['aplikasi', 1],
            //     ['sistem', 1]
            // ];
            // var jrg = [
            //     ['serangan', 1],
            //     ['jaringan', 1]
            // ];

            var rc = {
              rancang: ['rancang bangun','web','android']
            };
            var jr = {
              jaringan: ['server','jaringan','proxy']
            };
            var sp = {
              spk: ['pendukung','keputusan','spk']
            };
            var mul = {
              mlti: ['game','video','foto']
            };
            var an = {
              analis: ['analisis']
            };

            //Rancang B
            var arrRc = [];
            var rcLenght = 0;
            for (var i = 0; i < rc.rancang.length; i++) {
              // console.log(rc.rancang[i]);
              if(judulskripsi.match(rc.rancang[i])){
                  arrRc.push(rc.rancang[i]);
              }
            }
            rcLenght = arrRc.length;
            console.log("rancang "+rcLenght);

            //Jaringan
            var arrJr = [];
            var jrLenght = 0;
            for (var i = 0; i < jr.jaringan.length; i++) {
              if(judulskripsi.match(jr.jaringan[i])){
                  arrJr.push(jr.jaringan[i]);
              }
            }
            jrLenght = arrJr.length;
            console.log("jar "+jrLenght);

            //SPK
            var arrSPK = [];
            var spkLenght = 0;
            for (var i = 0; i < sp.spk.length; i++) {
              if(judulskripsi.match(sp.spk[i])){
                  arrSPK.push(sp.spk[i]);
              }
            }
            spkLenght = arrSPK.length;
            console.log("SPK "+spkLenght);

            //Multimedia
            var arrMulti = [];
            var mulLenght = 0;
            for (var i = 0; i < mul.mlti.length; i++) {
              if(judulskripsi.match(mul.mlti[i])){
                  arrMulti.push(mul.mlti[i]);
              }
            }
            mulLenght = arrMulti.length;
            console.log("Multimedia "+mulLenght);

            //Analisis
            var arrAn = [];
            var anLenght = 0;
            for (var i = 0; i < an.analis.length; i++) {
              if(judulskripsi.match(an.analis[i])){
                  arrAn.push(an.analis[i]);
              }
            }
            anLenght = arrAn.length;
            console.log("Analisis "+anLenght);

            //PROBABILITAS
            var probRc = 1/jm_dataset;
            var probJr = 1/jm_dataset;
            var probSp = 1/jm_dataset;
            var probMul = 1/jm_dataset;
            var probAn = 1/jm_dataset;
            var jmUnikWord = (rc.rancang.length)+(jr.jaringan.length)+(sp.spk.length)+(mul.mlti.length)+(an.analis.length);

            //Terdapat berapa kata dalam kat RB
            var jmKataRc = (rcLenght + 1)/(jm_dataset+jmUnikWord);
            var jmKataJr = (jrLenght + 1)/(jm_dataset+jmUnikWord);
            var jmKataSp = (spkLenght + 1)/(jm_dataset+jmUnikWord);
            var jmKataMul = (mulLenght + 1)/(jm_dataset+jmUnikWord);
            var jmKataAn = (anLenght + 1)/(jm_dataset+jmUnikWord);

            //FINAL RC
            var finalRc = probRc+jmKataRc;
            console.log(finalRc);

            //FINAL JR
            var finalJr = probJr+jmKataJr;
            console.log(finalJr);

            //FINAL SPK
            var finalSp = probSp+jmKataSp;
            console.log(finalSp);

            //FINAL Mul
            var finalMul = probMul+jmKataMul;
            console.log(finalMul);

            //FINAL Analisis
            var finalAn = probAn+jmKataAn;
            console.log(finalAn);

            if (finalRc > finalJr && finalRc > finalSp && finalRc > finalMul && finalRc > finalAn) {
              $("#klasifikasi").val("rancang bangun");
            } else if (finalJr > finalRc && finalJr > finalSp && finalJr > finalMul && finalJr > finalAn) {
              $("#klasifikasi").val("jaringan");
            }else if (finalSp > finalRc && finalSp > finalJr && finalSp > finalMul && finalSp > finalAn) {
              $("#klasifikasi").val("SPK");
            }else if (finalMul > finalRc && finalMul > finalJr && finalMul > finalSp && finalMul > finalAn) {
              $("#klasifikasi").val("multimedia");
            }else if (finalAn > finalRc && finalAn > finalJr && finalAn > finalMul && finalAn > finalSp) {
              $("#klasifikasi").val("Analisis");
            } else {
              $("#klasifikasi").val("TIDAK TERKLASIFIKASI");
            }

            // console.log(a);

            // for (var i = rancangbangun[0].length; i >= 0; i--) {
            //   if(judulskripsi.match(rancangbangun[i][0])){
            //     var arr = [rancangbangun[i][1]];
            //     var finarr = [arr[0]];
            //       console.log(finarr);
            //   }
            // }

            // for (var i = 0; i < rancangbangun.length; i++) {
            //   var a = [[rancangbangun[i][0]]];
            //   console.log(a);
            // }

            // rancangbangun.forEach(function(rancangbangun){
            //   if(judulskripsi.match(rancangbangun[0])){
            //       console.log(rancangbangun[1]);
            //   }
            // });

            // jrg.forEach(function(jrg){
            //   if(judulskripsi.match(jrg[0])){
            //       console.log(jrg[1]);
            //   }
            // });

            
            // console.log(judulskripsi)
            // if(judulskripsi.match("rancang bangun")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("rancang bangun");
            // } else if(judulskripsi.match("jaringan")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("jaringan");
            // } else if(judulskripsi.match("game")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("game");
            // }else if(judulskripsi.match("spk")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("spk");
            // }else if(judulskripsi.match("analisis")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("analisis");
            // }else if(judulskripsi.match("data mining")){
            //     $("#klasifikasi").val("");
            //     $("#klasifikasi").val("data mining");
            // }
            // else {
            //     $("#klasifikasi").val("");
            // }
        });
   });      
</script>
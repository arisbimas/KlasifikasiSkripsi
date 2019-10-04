<?php 

  include '../functions.php';

  $qskripsi = mysqli_query($conn,"SELECT*FROM tb_skripsi");
  $qjmlskripsi = mysqli_num_rows($qskripsi);

  $qvisitors = mysqli_query($conn,"SELECT*FROM tb_visitors");
  $qjmlvisitors = mysqli_fetch_row($qvisitors);

  $qdataset = mysqli_query($conn,"SELECT*FROM tb_dataset");
  $qjmlds = mysqli_num_rows($qdataset);

 ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main Menu
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $qjmlskripsi; ?></h3>
              <p>Skripsi</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="repository.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $qjmlvisitors[0]; ?></h3>

              <p>Jumlah Visitor</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">...</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $qjmlds; ?></h3>

              <p>Jumlah Data Set</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="dataset.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      

    </section>
    <!-- /.content -->
  </div> 
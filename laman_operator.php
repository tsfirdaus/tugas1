<?php 
  session_start();
  include 'koneksi.php';
 if($_SESSION['admin_login'] == true ){

 }else{
  header('location: laman.php');
 }

  if(isset($_GET['id_operator'])){
    $id_operator = $_GET['id_operator'];
    global $kon;
    $sql="UPDATE `operator` SET `role` = 'operator' WHERE `operator`.`id_operator` = $id_operator;";

        //Mengeksekusi/menjalankan query diatas
        mysqli_query($kon,$sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Data Siswa</title>
    <style>
        /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">INFO SISWA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link "  href="laman.php">HOME</a>

        </li>
        <?php if($_SESSION['admin_login'] == true):?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active " aria-current="page" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            OPERATION
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Add Operator</a></li>
            <!-- <li><button class="dropdown-item disabled"  onclick="ddisplay()">Change Number</button></li> -->
            <li><a class="dropdown-item disabled" href="#">Coming soon!</a></li>
          </ul>
        </li>
        <?php endif;?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            SYSTEM
          </a>
          <ul class="dropdown-menu">
          <?php if($_SESSION['admin_login'] == true):?>
            <?php else:?>
            <li><a class="dropdown-item" href="index.php?Verifikasi-login-sistem=Sistem-siap-LOGIN">LOGIN as admin</a></li>
            <li><a class="dropdown-item" href="login_siswa.php?Verifikasi-login-siswa=Siswa-siap-LOGIN">LOGIN as siswa</a></li>
            <?php endif;?>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search" action="" method="POST">
        <input class="form-control me-2" name="search" type="search" placeholder="Masukan code" aria-label="Search">
        <button class="btn btn-outline-light" name="sql">SQL</button>
      </form>
              <?php 
                      include "koneksi.php";
                if(isset($_POST['sql'])){
                  $sql_code = $_POST['search'];
                  $hasil_code=mysqli_query($kon,$sql_code);
                }
              ?>
    </div>
  </div>
</nav>
    <div class="container">
        
        <?php 

        //Cek apakah ada nilai dari method GET dengan ddnama id
        if (isset($_GET['id'])) {
            $id=htmlspecialchars($_GET["id"]);

            $sql="DELETE FROM operator where id_operator='$id' ";
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak
                if ($hasil) {
                  echo "<script>history.back(-1);</script>";

                }
                else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

                }
            }
        ?>
        
            <h4 class="mt-3">Set permission</h4>
<table class="table table-bordered table-hover table-warning">

        <?php
        include "koneksi.php";
        

        $hasil = mysqli_query($kon,"SELECT * FROM operator WHERE NOT role='operator'");
        if(mysqli_num_rows($hasil) == 0)
        {
          ?>
            <tr>
              <td>Tidak ada data</td>
            </tr>
          <?php
        }else{
        ?>
                <br>
        <thead>
        <tr>
        
            <th>Username</th>
            <th>Password</th>
            <th>Nama Lengkap</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <?php
        while ($data = mysqli_fetch_array($hasil)) {
            
        
            ?>
            <tbody>
            <tr>
                <td><?php echo $data["user"];   ?></td>
                <td><?php echo substr($data["pass"],0,30);?><br><?php echo substr($data["pass"],30,60);?></td>
                <td><?php echo $data["nama_lengkap"];   ?></td>
                <td><?php echo $data["no_hp"];   ?></td>
                <td><?php echo $data["email"];   ?></td>
                <?php if($_SESSION['admin_login'] == true):?>
                <td>
                <a class="btn btn-success" href="laman_operator.php?id_operator=<?= $data['id_operator']?>">Agree</a>
                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id_operator']; ?>" class="btn btn-danger" role="button">Disagree</a>
                </td>
                <?php endif;?>
            </tbody>
            <?php
            $no++;
        }
        
      }
        ?>
    </table>
    <div class="text-center mb-4">
    </div>
    <h4 class="mt-3">Operator member</h4>

<table class="table table-bordered table-hover">

        <?php
        include "koneksi.php";
        

        $hasil1 = mysqli_query($kon,"SELECT * FROM operator WHERE role='operator'");
        if(mysqli_num_rows($hasil1) == 0)
        {
          ?>
            <tr>
              <td>Tidak ada data</td>
            </tr>
          <?php
        }else{
          ?>
          <br>
          <thead>
          <tr>
          
              <th>Username</th>
              <th>Password</th>
              <th>Nama Lengkap</th>
              <th>No HP</th>
              <th>Email</th>
          </tr>
          </thead>
          <?php
        while ($data = mysqli_fetch_array($hasil1)) {
            
        
            ?>
            <tbody>
            <tr>
                <td><?php echo $data["user"];   ?></td>
                <td><?php echo substr($data["pass"],0,30);?><br><?php echo substr($data["pass"],30,60);?></td>
                <td><?php echo $data["nama_lengkap"];   ?></td>
                <td><?php echo $data["no_hp"];   ?></td>
                <td><?php echo $data["email"];   ?></td>
                <?php if($_SESSION['admin_login'] == true):?>
                <td>
                <a href="update_operator.php?id=<?php echo htmlspecialchars($data['id_operator']); ?>" class="btn btn-warning" role="button">Update</a>

                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id_operator']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
                <?php endif;?>
            </tbody>
            <?php
            $no++;
          }
        }
        ?>
    </table>
    <div class="text-center">
    </div>
    <?php if($_SESSION['admin_login'] == true):?>
    <a href="create_operator.php" class="btn btn-dark mb-5" role="button">Tambah Data</a>
      <?php else:?>
        <p class="mb-5"></p>
        <p class="mb-5"></p>
        <?php endif;?>
    </div>
    <!-- <form action="" method="POST" id="dnone" class="d-none bg-dark p-3 rounded position-absolute top-50 start-50 translate-middle">
        <input class="form-control mb-3" name="s_number" type="search" placeholder="Default kosong" aria-label="Search">
        <button class="btn btn-outline-light" onclick="dnone()">Back</button>
        <button class="btn btn-outline-light" type="submit" onclick="" name="c_number">Change</button>
    </form> -->

    <?php

    ?>
    <script>
      	function dnone()
	{
		dnone = document.querySelector('#dnone');
		dnone.classList.add('d-none');
	}
      	function ddisplay()
	{
		ddisplay = document.querySelector('#dnone');
		ddisplay.classList.remove('d-none');
	}
    </script>
</body>
</html>

<?php 
  session_start();
  if($_SESSION['siswa_login-1'] == true){

  }else{
    header('location: laman.php');
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
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            OPERATION
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="laman_operator.php">Add Operator</a></li>
            <li><a class="dropdown-item disabled" href="#">Coming soon!</a></li>
          </ul>
        </li>
        <?php endif;?>
        <li class="nav-item">
          <a class="nav-link active" href="">PROFIL</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            SYSTEM
          </a>
          <ul class="dropdown-menu">
          <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true || $_SESSION['siswa_login'] == true):?>
            <?php else:?>
              <li><a class="dropdown-item" href="index.php?Verifikasi-login-sistem=Sistem-siap-LOGIN">LOGIN as user+</a></li>
            <li><a class="dropdown-item" href="login_siswa.php?Verifikasi-login-siswa=Siswa-siap-LOGIN">LOGIN as siswa</a></li>
              <?php endif;?>
              <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true || $_SESSION['siswa_login'] == true):?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            <?php endif;?>
          </ul>
        </li>
      </ul>


    </div>
  </div>
</nav>
    <div class="container">
        
        <?php 
        include "koneksi.php";
        //Cek apakah ada nilai dari method GET dengan ddnama id

        ?>

        <br>
        <?php
        include "koneksi.php";
        $id_siswa = $_GET['id'];
        $sql = "SELECT * FROM info_siswa WHERE id=$id_siswa";
        
        $hasil=mysqli_query($kon,$sql);
        
        while ($data = mysqli_fetch_array($hasil)) {

            ?>
          
            <tr>
            <div class="card w-50 mx-auto">
  <h5 class="card-header"><?= $data['nis']; ?></h5>
  <div class="card-body">
    <h5 class="card-title"><?= $data['nama_lengkap']; ?></h5>
    <table class="table text-center">
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><?= $data['tempat_lahir']; ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?= $data['tanggal_lahir']; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= $data['jenis_kelamin']; ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $data['kelas']; ?></td>
        </tr>
    </table>
    <div class="d-flex justify-content-between">
        <a class="button btn-outline-warning btn" href="laman.php">Back</a>
    <a href="update_siswa.php?id=<?=$id_siswa;?>" class="btn btn-warning">Update</a>
    </div>
  </div>
</div>
                <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true):?>
                <td>
                <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>

                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
                <?php endif;?>
       
            <?php
            $no++;
        }
        ?>
    <div class="text-center">
    </div>
    <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true):?>
    <a href="create.php" class="btn btn-dark mb-5" role="button">Tambah Data</a>
      <?php else:?>
        <p class="mb-5"></p>
        <p class="mb-5"></p>
        <?php endif;?>
    </div>
</body>
</html>

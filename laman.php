<?php 
  session_start();

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
          <a class="nav-link active" aria-current="page" href="#">HOME</a>
        </li>
        <?php if($_SESSION['admin_login'] == true):?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            OPERATION
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="laman_operator.php">Add Operator</a></li>
                        <!-- <li><button class="dropdown-item "  onclick="ddisplay()">Change Number</button></li> -->
            <li><a class="dropdown-item disabled" href="#">Coming soon!</a></li>
          </ul>
        </li>
        <?php endif;?>
        <?php if($_SESSION['siswa_login'] == true):?>
        <li class="nav-item">
          <a class="nav-link " href="profil_siswa.php?id=<?=$_SESSION['siswa_login']?>">PROFIL</a>
        </li>
        <?php endif;?>
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
              <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true ||$_SESSION['siswa_login'] == true):?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            <?php endif;?>
          </ul>
        </li>

      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" name="search" type="search" placeholder="<?php
        if($_SESSION['admin_login'] == true){echo 'Selamat datang admin';}elseif($_SESSION['operator_login']==true){echo 'Selamat datang operator';}elseif($_SESSION['siswa_login'] == true){echo 'Selamat datang siswa';}else{echo 'Search';};?>" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>

    </div>
  </div>
</nav>
    <div  class="container">
        
        <?php 
        include "koneksi.php";
        //Cek apakah ada nilai dari method GET dengan ddnama id
        if (isset($_GET['id'])) {
            $id=htmlspecialchars($_GET["id"]);

            $sql="DELETE FROM info_siswa where id='$id' ";
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    // header("Location:index.php");
                  echo "<script>history.back(-1);</script>";
                }
                else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

                }
            }
        ?>

<table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nisn</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal lahir</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
        </tr>
        </thead>
        <?php
        include "koneksi.php";
        
        $jumlahdataperhalaman = 10;

        $ambildata1 = mysqli_query($kon,"SELECT * FROM info_siswa");

        $jumlahdata = mysqli_num_rows($ambildata1);

        $jumlahpage = ceil( $jumlahdata / $jumlahdataperhalaman);

        if(isset($_GET['halaman'])){

        $halamanaktif = $_GET['halaman'];

        }else{

            $halamanaktif = 1;

        }

        $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

        $no = $halamanaktif + ($halamanaktif - 1) * ($jumlahdataperhalaman - 1);

        $sql = "SELECT * FROM info_siswa LIMIT $awaldata,$jumlahdataperhalaman";

        $hasil=mysqli_query($kon,$sql);

        $search = $_GET['search'];

        if(isset($_GET['search'])){
   
            $hasil = mysqli_query($kon,"SELECT * FROM info_siswa WHERE 
            
            nis LIKE '%$search%' OR

            nama_lengkap LIKE '%$search%' OR

            tempat_lahir LIKE '%$search%' OR

            tanggal_lahir LIKE '%$search%' OR

            jenis_kelamin LIKE '%$search%' OR

            kelas LIKE '%$search%'");

        }
        if($search == ""){
          $sql = "SELECT * FROM info_siswa LIMIT $awaldata,$jumlahdataperhalaman";

          $hasil=mysqli_query($kon,$sql);
        }

        
        while ($data = mysqli_fetch_array($hasil)) {
            
        
            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?>.</td>
                <td><?php echo $data["nis"];   ?></td>
                <td><?php echo $data["nama_lengkap"];   ?></td>
                <td><?php echo $data["tempat_lahir"];   ?></td>
                <td><?php echo $data["tanggal_lahir"];   ?></td>
                <td><?php echo strtoupper($data["jenis_kelamin"]);   ?></td>
                <td><?php echo strtoupper($data["kelas"]);   ?></td>
                <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true):?>
                <td>
                <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>

                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
                <?php endif;?>
            </tbody>
            <?php
            $no++;
        }
        ?>
    </table>
    <div class="text-center">
    <form action="" method="get" class="mx-auto my-3">

<?php if($halamanaktif == 1):?><a class="btn">&lt;</a><?php endif;?>

<?php if($halamanaktif >1):?><a class="btn"
    href="?halaman=<?=$halamanaktif - 1?>">&lt;</a><?php endif;?>

<span>Page <input type="number" class="text-center" min="0" value="<?= $halamanaktif;?>" max="<?=$jumlahpage;?>"
        name="halaman" id="number"> Of <?= $jumlahpage; ?></span>

<?php if($halamanaktif < $jumlahpage):?><a class="btn"
    href="?halaman=<?=$halamanaktif + 1?>">&gt;</a><?php endif;?>

<?php if($halamanaktif == $jumlahpage):?><a class="btn">&gt;</a><?php endif;?>

</form>
    </div>
    <?php if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true):?>
    <a href="create.php" class="btn btn-dark mb-5" role="button">Tambah Data</a>
      <?php else:?>
        <p class="mb-5"></p>
        <p class="mb-5"></p>
        <?php endif;?>
    </div>
    <!-- <form action="" method="post" id="dnone" class="d-none bg-dark p-3 rounded position-absolute top-50 start-50 translate-middle">
        <input class="form-control mb-3" name="s_number" type="search" placeholder="Default kosong" aria-label="Search">
        <button class="btn btn-outline-light" onclick="dnone()">Back</button>
        <button class="btn btn-outline-light" name="c_number">Change</button>
    </form> -->

    <?php 
      if(isset($_POST['c_number'])){

      }

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


<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <!-- Load file CSS Bootstrap offline -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <?php
       session_start();
      if($_SESSION['siswa_login-1'] == true){

    }else{
      header('location: laman.php');
    }
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama_lengkap id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from info_siswa where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $nis=input($_POST["nis"]);
        $nama_lengkap=input($_POST["nama_lengkap"]);
        $tempat_lahir=input($_POST["tempat_lahir"]);
        $tanggal_lahir=input($_POST["tanggal_lahir"]);
        $jenis_kelamin=input($_POST["jenis_kelamin"]);
        $kelas=input($_POST["kelas"]);

        //Query update data pada tabel anggota
        $sql="update info_siswa set
			nis='$nis',
			nama_lengkap='$nama_lengkap',
			tempat_lahir='$tempat_lahir',
			tanggal_lahir='$tanggal_lahir',
            jenis_kelamin='$jenis_kelamin',
			kelas='$kelas'
            where id=$id";
			
        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>nis:</label>
            <input type="text" name="nis" class="form-control" value="<?php echo $data['nis']; ?>" placeholder="Masukan nis" required />
            

        </div>
        <div class="form-group">
            <label>nama_lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" placeholder="Masukan nama_lengkap" required />


        </div>
        <div class="form-group">
            <label>tempat lahir:</label>
            <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data['tempat_lahir']; ?>" placeholder="Tempat lahir" required />


        </div>
        <div class="form-group">
            <label>Tanggal lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>" placeholder="Masukan tanggal_lahir" required />


        </div>

        <div class="form-group">
            <label>Jenis kelamin:</label>
            <input type="jenis_kelamin" name="jenis_kelamin" class="form-control" value="<?php echo $data['jenis_kelamin']; ?>" placeholder="Masukkan jenis kelamin" required />


        </div>

        <div class="form-group mb-3">
            <label>Kelas:</label>
            <input type="text" name="kelas" class="form-control" value="<?php echo $data['kelas']; ?>" placeholder="Masukan No HP" required />


        </div>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <a class="btn btn-outline-warning" href="profil_siswa.php?id=<?=$id;?>">Back</a>

        <button type="submit" name="submit" class="btn btn-warning">Submit</button>
    </form>
</div>
</body>
</html>
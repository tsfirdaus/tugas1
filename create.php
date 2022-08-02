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
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    if($_SESSION['admin_login'] == true || $_SESSION['operator_login'] == true){
    }else{
     header('location: laman.php');
    }
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nis=input($_POST["nis"]);
        $nama_lengkap=input($_POST["nama_lengkap"]);
        $tempat_lahir=input($_POST["tempat_lahir"]);
        $tanggal_lahir=input($_POST["tanggal_lahir"]);
        $jenis_kelamin=input($_POST["jenis_kelamin"]);
        $kelas=input($_POST["kelas"]);


        //Query input menginput data kedalam tabel anggota
        $sql="insert into info_siswa (nis,nama_lengkap,tempat_lahir,tanggal_lahir,jenis_kelamin,kelas) values
		('$nis','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$kelas')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>nis:</label>
            <input type="text" name="nis" class="form-control" placeholder="Masukan NISN" required />

        </div>
        <div class="form-group">
            <label>nama_lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan nama_lengkap" required/>

        </div>
        <div class="form-group">
            <label>Tempat Lahir:</label>
            <textarea name="tempat_lahir" class="form-control" placeholder="Masukan tempat_lahir" required></textarea>

        </div>
        <div class="form-group">
            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukan tanggal_lahir" required/>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <input type="text" name="jenis_kelamin" class="form-control" placeholder="Masukan jenis_kelamin" required/>
        </div>

        <div class="form-group mb-3">
            <label>Program Keahlian:</label>
            <input type="text" name="kelas" class="form-control" placeholder="Masukan kelas" required/>
        </div>
        <button class="btn btn-outline-dark" onclick="history.back(-1) ">Back</button>

        <button type="submit" name="submit" class="btn btn-dark">Submit</button>
    </form>     
</div>
</body>
</html>
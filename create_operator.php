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
    if($_SESSION['admin_login'] == true ){

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

        $user=input($_POST["user"]);
        $pass=password_hash(input($_POST["pass"]),CRYPT_SHA256);
        $nama_lengkap=input($_POST["nama_lengkap"]);
        $no_hp=input($_POST["no_hp"]);
        $email=input($_POST["email"]);


        //Query input menginput data kedalam tabel anggota
        $sql="insert into operator (user,pass,nama_lengkap,no_hp,email,role) values
		('$user','$pass','$nama_lengkap','$no_hp','$email','operator')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:laman_operator.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="user" class="form-control" placeholder="Masukan username" required />

        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="pass" class="form-control" placeholder="Masukan password" required/>

        </div>
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan nama lengkap" required></input>

        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="number" name="no_hp" class="form-control" placeholder="Masukan no hp" required/>
        </div>

        <div class="form-group mb-3">
            <label>email:</label>
            <input type="email" name="email" class="form-control" placeholder="Masukan email" required/>
        </div>
        <button class="btn btn-outline-dark" onclick="history.back(-1) ">Back</button>
        <button type="submit" name="submit" class="btn btn-dark">Submit</button>
    </form>     
</div>
</body>
</html>
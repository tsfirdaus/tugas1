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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan pass id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from operator where id_operator=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $user=input($_POST["user"]);
        $pass=password_hash(input($_POST["pass"]),CRYPT_SHA256);
        $nama_lengkap=input($_POST["nama_lengkap"]);
        $no_hp=input($_POST["no_hp"]);
        $email=input($_POST["email"]);

        //Query update data pada tabel anggota
        $sql="update operator set
			user='$user',
			pass='$pass',
			nama_lengkap='$nama_lengkap',
			no_hp='$no_hp',
            email='$email',
            role='operator'
            where id_operator=$id";
			
        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:laman_operator.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="user" class="form-control" value="<?php echo $data['user']; ?>" placeholder="Masukan user" required />
            

        </div>
        <div class="form-group">
            <label>pass:</label>
            <input type="text" name="pass" class="form-control" value="<?php echo $data['pass']; ?>" placeholder="Masukan pass" required />


        </div>
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" placeholder="Tempat lahir" required />


        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>" placeholder="Masukan no_hp" required />


        </div>

        <div class="form-group mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Masukkan jeuser kelamin" required />


        </div>

        <input type="hidden" name="id" value="<?php echo $data['id_operator']; ?>" />
        <button class="btn btn-outline-warning" onclick="history.back(-1) ">Back</button>

        <button type="submit" name="submit" class="btn btn-warning">Submit</button>
    </form>
</div>
</body>
</html>
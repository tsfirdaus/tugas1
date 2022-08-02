<?php 
    session_start();
    include 'koneksi.php';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if (isset($_POST['submit1'])) {

        $user=input($_POST["user1"]);
        $pass=password_hash(input($_POST["pass1"]),CRYPT_SHA256);
        $nama_lengkap=input($_POST["nama_lengkap1"]);
        $no_hp=input($_POST["no_hp1"]);
        $email=input($_POST["email1"]);


        //Query input menginput data kedalam tabel anggota
        $sql="insert into operator (user,pass,nama_lengkap,no_hp,email) values
		('$user','$pass','$nama_lengkap','$no_hp','$email')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:laman.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
?>
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

<h2>Input Data</h2>
    <button id="b_1" onclick="dnone1()" class="btn btn-dark">OPSI 2</button>
    <button onclick="dnone()" class="d-none btn btn-dark" id="b_2">OPSI 1</button>

    <form action="kirim_data.php" method="post" id="opsi_2" class="d-none">



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

        <div class="form-group mb-3">
            <label>Change number <br><i>admin fitur</i>:</label>
            <input type="text" name="s_number" class="form-control" placeholder="Default Kosong" />
        </div>

        <a class="btn btn-outline-dark" href='index.php?Verifikasi-login-sistem=Sistem-siap-LOGIN'>Back</a>
        <button type="submit" name="submit" class="btn btn-dark">Input Data</button>
        <?php
        $user = $_POST['user'];
        $pass = password_hash($_POST['pass'],CRYPT_SHA256);
        $nama_lengkap = $_POST['nama_lengkap'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];
        $kirim_sql = "insert into operator (user,pass,nama_lengkap,no_hp,email,role) values
		('$user','$pass','$nama_lengkap','$no_hp','$email','operator')"?>
                <!-- <a class="btn btn-dark " target="_blank" href="https://wa.me/ name="submit">Kirim</a> -->
                <!-- <form action="" method="POST"> -->
    <!-- <div class="form-group mt-3">
            <label >Change number</label>
        <input class="form-control mb-3" name="s_number" type="search" placeholder="Default kosong" aria-label="Search">
        <button class="btn btn-dark" name="c_number">Change</button>

        </div> -->
    <!-- </form>     -->
    </form>
    <form action="" method="post" id="opsi_1" class="">

        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="user1" class="form-control" placeholder="Masukan username" required />

        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="pass1" class="form-control" placeholder="Masukan password" required/>

        </div>
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap1" class="form-control" placeholder="Masukan nama lengkap" required></input>

        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="number" name="no_hp1" class="form-control" placeholder="Masukan no hp" required/>
        </div>

        <div class="form-group mb-3">
            <label>email:</label>
            <input type="email" name="email1" class="form-control" placeholder="Masukan email" required/>
        </div>


        <a class="btn btn-outline-dark" href='index.php?Verifikasi-login-sistem=Sistem-siap-LOGIN'>Back</a>
        <button type="submit" name="submit1" class="btn btn-dark">Input Data</button>


    </form>


</div>
</body>
</html>
<script>

      	function dnone1()
	{
        b1 = document.querySelector('#b_1')
        b2 = document.querySelector('#b_2')
        op1 = document.querySelector('#opsi_1')
        op2 = document.querySelector('#opsi_2')
        b1.classList.add('d-none');
        b2.classList.remove('d-none');
        op1.classList.add('d-none');
        op2.classList.remove('d-none');
        
	}
      	function dnone()
	{
        b1 = document.querySelector('#b_1')
        b2 = document.querySelector('#b_2')
        op1 = document.querySelector('#opsi_1')
        op2 = document.querySelector('#opsi_2')
        b2.classList.add('d-none');
        b1.classList.remove('d-none');
        op2.classList.add('d-none');
        op1.classList.remove('d-none');
        
	}
    </script>
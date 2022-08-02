
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<form action="" method="post" id="dnone" class=" bg-dark p-5 rounded position-absolute top-50 start-50 translate-middle">
<div>
    <label class="text-light">Link:</label>
<?php
       session_start();
    $user = $_POST['user'];
    $pass = password_hash($_POST['pass'],CRYPT_SHA256);
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $kirim_sql = "insert into operator (user,pass,nama_lengkap,no_hp,email,role) values
    ('$user','$pass','$nama_lengkap','$no_hp','$email','operator')"?>
    <?php 
       
    ?>
<input class="form-control mb-5" name="s_number" type="search" value="https://wa.me/<?php if($_POST['s_number'] == ""){echo '6287804022550';}elseif(isset($_POST['s_number'])){echo $_POST['s_number'];};?>?text=<?=$kirim_sql?>" placeholder="Default kosong" aria-label="Search">
    </div>
    <a class="btn btn-dark" href="registrasi.php" >Back</a>
    <a class="btn btn-light"  href="https://wa.me/<?php if($_POST['s_number'] == ""){echo '6287804022550';}elseif(isset($_POST['s_number'])){echo $_POST['s_number'];};?>?text=<?=$kirim_sql?>">Submit</a>

    </form>
</body>
</html>



<?php 
    include 'koneksi.php';


session_start();



    if(isset($_POST['login'])){
        
        $nis = $_POST['nis'];
        $nama_lengkap = $_POST['nama_lengkap'];

        $result = mysqli_query($kon,"SELECT * FROM info_siswa WHERE nama_lengkap = '$nama_lengkap'");
        if(mysqli_num_rows($result) === 1){
            $data = mysqli_fetch_assoc($result);
            if($nis === $data['nis']){
                $_SESSION['siswa_login'] = $data['id'];
                $_SESSION['siswa_login-1'] = true;
                header('location: profil_siswa.php?id='.$data['id']);
                exit;
            }
    
        }
        $error = true;
        
    }

    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link rel="stylesheet" href="stydex.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login Siswa</h2>
        <br>
        <div class="card mt-5">
          <form class="card-body cardbody-color p-lg-4" method="POST" action=''>
            <div class="mb-3">
              <input type="text" class="form-control" id="Username" name="nis" aria-describedby="emailHelp"
                placeholder="Masukan NIS SISWA">
            </div>
            <div class="mb-3">
              <input type="text" name="nama_lengkap" class="form-control" id="password" placeholder="Masukan Nama Lengkap Siswa">
            </div>
            <div class="text-center"><input type="submit" name="login" class="btn btn-color   w-100" value="Login"></div>
            <div class="text-center"><a onclick=" window.history.back(-1)" class="btn btn-color   w-100">Back</a></div>
          </form>
        </div>
       

      </div>
    </div>
    <div class="w-50 mx-auto">
    <?php if($error==true):?><div class=" alert alert-danger text-center" role="alert"><p class=" text-danger fst-bold fst-italic ">Nis siswa/Nama Lengkap salah!!!</p></div><?php endif;?>
  
    </div>
  </div>
</body>
</html>





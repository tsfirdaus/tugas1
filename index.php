<?php 
    include 'koneksi.php';


session_start();

if($_GET['Verifikasi-login-sistem'] == []){

  header('Location: laman.php');

}else if ($_GET['Verifikasi-login-sistem'] == 'Sistem-siap-LOGIN'){

  

}


    if(isset($_POST['login'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($kon,"SELECT * FROM moderator WHERE user = '$username'");
        $result_op = mysqli_query($kon,"SELECT * FROM operator WHERE user = '$username' AND role='operator'");
        if(mysqli_num_rows($result) === 1 || mysqli_num_rows($result_op) === 1 ){
            $data = mysqli_fetch_assoc($result);
            $data_op = mysqli_fetch_assoc($result_op);
            if(password_verify($password,$data['pass'])){
                header('location: laman.php');
                $_SESSION['admin_login'] = true;
                exit;
            }
            if(password_verify($password,$data_op['pass'])){
                header('location: laman.php');
                $_SESSION['operator_login'] = true;
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
        <h2 class="text-center text-dark mt-5">Login Sistem</h2>
        <br>
        <div class="card mt-5">
          <form class="card-body cardbody-color p-lg-4" method="POST" action=''>
            <div class="mb-3">
              <input type="text" class="form-control" id="Username" name="username" aria-describedby="emailHelp"
                placeholder="Masukan Username">
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password">
            </div>
            <div class="text-center"><input type="submit" name="login" class="btn btn-color   w-100" value="Login"></div>
            <div class="text-center"><a href="laman.php" class="btn btn-color   w-100">Back</a></div>
            <div class="d-flex justify-content-between ">
         
         <p></p>
         <p>    <a href="registrasi.php"  class="btn">Sign Up</a></p>
         </div>

  

           
              
          </form>


        </div>



      </div>

    </div>
    <div class="w-50 mx-auto">
    <?php if($error==true):?><div class=" alert alert-danger text-center" role="alert"><p class=" text-danger fst-bold fst-italic ">Username/Password salah!!!</p></div><?php endif;?>
  
    </div>
  </div>
</body>
</html>
<?php 
  
?>





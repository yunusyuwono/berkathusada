<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<!DOCTYPE html>
<html lang="en">
<?php 
include 'koneksi.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">Berkat Husada</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="icon" href="#">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/toastify/toastify.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">BERKAT HUSADA KAUR</h5>
            <h5 class="text-center fw-light">Login</h5>

            <?php 
            if(isset($_POST['login']))
            {
              $email=addslashes($_POST['email']);
              $pas=md5(addslashes($_POST['pas']));
              $akses=$_POST['akses'];

              $glog=mysqli_query($kon,"select * from user where email='$email' and pas='$pas' and status like '%$akses%'");
              if(mysqli_num_rows($glog)>0)
              {
                session_start();
                $g=mysqli_fetch_array($glog);
                $_SESSION['iduser']=$g['id'];
                $_SESSION['kode']=$g['kode'];
                $_SESSION['email']=$g['email'];
                $_SESSION['akses']=$akses;

                switch ($akses) {
                  case 'Admin Center':
                    header("location:./");
                    break;

                  case 'Klinik':
                    header("location:klinik");
                    break;

                  case 'Apotek':
                    header("location:apotek");
                    break;
                  case 'Dokter':
                    header("location:dokter");
                    break;
                  case 'Kasir':
                    header("location:kasir");
                    break;
                  case 'CS':
                    header("location:cs");
                    break;
                    case 'Praktek':
                      header("location:praktek");
                      break;
                }
              }
              else
              {
                ?>
                <div class="alert alert-danger">
                  Login gagal. Username atau Password salah atau anda tidak memiliki akses untuk masuk ke <?=$akses;?>. Silahkan coba lagi.
                </div>
                <?php
              }
            }
            ?>
            <form method="post">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" required placeholder="name@example.com">
                <label for="floatingInput">Email</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name="pas" class="form-control" id="floatingPassword" required placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="mb-3">
                <select name="akses" class="form-control" required>
                  <option>Pilih Akses</option>
                  <option value="Admin Center">Admin Center</option>
                  <option value="Apotek">Apotek</option>
                  <option value="Klinik">Klinik</option>
                  <option value="Dokter">Dokter</option>
                  <option value="Kasir">Kasir</option>
                  <option value="CS">CS</option>
                  <option value="Praktek">Praktek</option>
                </select>
                
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" name="login" type="submit">Login</button>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    
</body>
</html>

<?php
include "koneksi.php";
session_start();
if ($_SESSION['login'] == true) {
?>
    <script>
        document.location = 'dashboard.php';
    </script>
    <?php
}


if (isset($_POST['login'])) {
    $error = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    if (mysqli_num_rows($query) == true) {
        $hasilQuery = mysqli_fetch_assoc($query);
        if ($hasilQuery["username"] == $username && $hasilQuery["password"] == $password) {
            $_SESSION['id'] = $hasilQuery["id"];
            $_SESSION['username'] = $hasilQuery["username"];
            $_SESSION['login'] = true;
    ?>
            <script>
                alert("Selamat datang di Sistem Penilaian Beladiri Disabilitas")
                document.location = 'dashboard.php';
            </script>
        <?php
        }
    } else {
        $error = true;
        ?>
        <script>
            alert("Akun tidak ditemukan, harap masukkan dengan benar")
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPBD - Login</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div id="auth-left">
                    <h1 class="auth-title">Login</h1>
                    <p>Sistem Pelatihan Beladiri Disabilitas</p>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group position-relative">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                        </div>
                        <div class="form-group position-relative">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                        </div>
                        <div class="tampilanError">
                            <?php if (isset($_POST['login'])) {
                                if ($error == true) {
                            ?>
                                    <p class="text-danger">Data yang anda masukkan salah!</p>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" name="login">Log in</button>
                    </form>
                    Belum memiliki akun ? <a href="register.php">Register</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right" class="vh-100 overflow-hidden d-flex justify-content-center">
                    <img src="assets/images/halaman_login.jpeg" style="width: 100%; height: auto">
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>
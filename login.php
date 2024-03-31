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
</head>

<body>
    <h1>Login</h1>
    <?php if ($error) {
    ?>
        <h1>Akun tidak ditemukan, harap masukkan dengan benar</h1>
    <?php
    } ?>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <button type="submit" name="login">Submit</button>
    </form>

    Belum memiliki akun ? <a href="register.php">Register</a>
</body>

</html>
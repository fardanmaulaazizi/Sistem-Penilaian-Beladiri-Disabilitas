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

if (isset($_POST['register'])) {
    $error = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($query) == true) {
        $error = true;
        $hasilQuery = mysqli_fetch_assoc($query);
        if ($hasilQuery["username"] == $username) {
    ?>
            <script>
                alert("Username telah digunakan, mohon gunakan username lain")
            </script>
        <?php
        }
    } else {
        $query = mysqli_query($conn, "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$passwordenc')");
        if ($query) {
        ?>
            <script>
                alert("Akun berhasil dibuat, silahkan melakukan login");
                document.location = 'login.php';
            </script>
<?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPBD - Register</title>
</head>

<body>
    <h1>Register</h1>
    <?php if ($error) {
    ?>
        <h1>Username telah digunakan, mohon gunakan username lain</h1>
    <?php
    } ?>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <button type="submit" name="register">Submit</button>
    </form>

    Sudah memiliki akun? <a href="login.php">Login</a>
</body>

</html>
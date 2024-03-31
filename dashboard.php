<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION["login"])) {
?>
    <script>
        document.location = 'index.php';
    </script>
<?php
}

if (isset($_POST["logout"])) {
    session_start();
    session_destroy();
?>
    <script>
        document.location = 'index.php';
    </script>
<?php
}

$userId = $_SESSION['id'];

$dataStudent = mysqli_query($conn, "SELECT * FROM student WHERE id_teacher = $userId")

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPBD - Dashboard</title>
</head>

<body>
    <a href="daftar_siswa.php"><Button>Daftar Siswa</Button></a>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post"><button type="submit" name="logout">Logout</button></form>
    <h1>Penilaian siswa</h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et totam incidunt voluptatem neque quaerat veniam tempore sint quas est doloribus laudantium sit perferendis ipsam cumque maiores sed quos dolor debitis quasi nesciunt, iusto iure eveniet dolores? Explicabo, similique facilis. Accusamus ullam beatae voluptatibus perferendis et omnis dignissimos asperiores debitis repudiandae aliquam, nostrum inventore enim odio, assumenda expedita, saepe doloremque corporis quia sequi numquam id cupiditate cumque vel! Reprehenderit enim vitae assumenda alias adipisci quam, similique explicabo eligendi consequatur corporis soluta quod ratione asperiores et beatae itaque nemo, facere quo inventore atque maiores porro aspernatur ducimus non. Illo recusandae similique in?</p>
    <div class="card-body table-responsive">
        <table class="table " id="tabel1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Skor</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($data = mysqli_fetch_assoc($dataStudent)) {
                ?>
                    <tr>
                        <td><?= $i;
                            ++$i ?></td>
                        <td><?= $data["name"] ?></td>
                        <td><?= $data["score"] ?></td>
                        <td>
                            <a href="nilai.php?id=<?= $data["id"] ?>"><button>Nilai</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</body>

</html>
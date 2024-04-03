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
    <link rel="stylesheet" href="assets/css/dashboard/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/style.css">
    <title>SPBD - Dashboard</title>
</head>

<body class="m-5">
    <div class="d-flex w-100 justify-content-between d-flex align-items-center">
        <h1>Penilaian siswa</h1>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="py-3"><button type="submit" class="btn btn-danger" name="logout">Logout</button></form>
    </div>
    <div class="deskripsi py-3">
        <p>Aplikasi sistem pelatihan beladiri untuk disabilitas merupakan inovasi yang signifikan dalam memungkinkan individu dengan berbagai kebutuhan khusus untuk belajar dan berkembang dalam bidang beladiri. Salah satu komponen penting dalam aplikasi ini adalah proses penilaian latihan beladiri. Terdapat lima langkah kunci dalam melakukan penilaian tersebut.</p>
        <p>Dengan mengikuti langkah-langkah ini, aplikasi sistem pelatihan beladiri untuk disabilitas dapat menjadi sarana yang efektif dalam memfasilitasi pertumbuhan dan kemandirian bagi individu dengan berbagai tantangan fisik dan mental.</p>
    </div>
    <div class="card-body table-responsive">
        <div class="row justify-content-center">
            <div class="col-md-9 p-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Siswa</h4>
                        <div class="card-header-action">
                            <a href="daftar_siswa.php" class="btn btn-success">Tambah Siswa</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Skor</th>
                                    <th>Nilai</th>
                                </tr>
                                <?php $i = 1;
                                while ($data = mysqli_fetch_assoc($dataStudent)) {
                                ?>
                                    <tr>
                                        <td><?= $i;
                                            ++$i ?></td>
                                        <td class="font-weight-600"><?= $data["name"] ?></td>
                                        <td>

                                            <?php if ($data["score"] == 0) { ?>
                                                <div class="badge badge-danger"><?= $data["score"] ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="badge badge-success"><?= $data["score"] ?>
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="nilai.php?id=<?= $data["id"] ?>" class="btn btn-primary">Nilai</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
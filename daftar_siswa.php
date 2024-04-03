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

$userId = $_SESSION['id'];
$dataStudent = mysqli_query($conn, "SELECT * FROM student WHERE id_teacher = $userId");

if (isset($_POST['tambah_siswa'])) {
    $namaSiswa = $_POST["nama_siswa"];
    $query = mysqli_query($conn, "INSERT INTO `student` (`id`, `name`, `score`, `id_teacher`) VALUES (NULL, '$namaSiswa', '0', $userId);");
    if ($query) {
    ?>
        <script>
            alert("Siswa berhasil ditambahkan");
            document.location = 'daftar_siswa.php';
        </script>
    <?php
    }
}

if (isset($_GET['hapus'])) {
    $idSiswa = $_GET['hapus'];
    $query = mysqli_query($conn, "DELETE FROM student WHERE id = '$idSiswa'");
    if ($query) {
    ?>
        <script>
            alert("Siswa berhasil dihapus");
            document.location = 'daftar_siswa.php';
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
    <link rel="stylesheet" href="assets/css/dashboard/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/style.css">
    <title>SPBD - Daftar Siswa</title>
</head>

<body class="m-5">
    <a href="dashboard.php"><Button class="btn btn-danger mb-5">Kembali ke dashboard</Button></a>

    <div class="d-flex w-100 justify-content-between align-items-center">
        <h2>Daftar Siswa</h2>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-flex">
            <input type="text" name="nama_siswa" placeholder="Nama Siswa" class="form-control mr-2">
            <button type="submit" name="tambah_siswa" class="btn btn-primary">Tambah</button>
        </form>
    </div>
    <div class="card-body table-responsive">
        <div class="row justify-content-center">
            <div class="col-md-9 p-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Siswa</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
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
                                            <a href="?hapus=<?= $data["id"] ?>" class="btn btn-danger">Hapus</a>
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
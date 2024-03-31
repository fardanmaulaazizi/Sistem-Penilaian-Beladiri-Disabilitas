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
    <title>SPBD - Dashboard</title>
</head>

<body>
    <a href="dashboard.php"><Button>Kembali ke dashboard</Button></a>
    <div class="tambah-siswa">
        <h1>Tambah siswa</h1>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="nama_siswa" placeholder="nama_siswa">
            <button type="submit" name="tambah_siswa">Tambah</button>
        </form>
    </div>

    <h1>Daftar siswa</h1>
    <div class="card-body table-responsive">
        <table class="table " id="tabel1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Skor</th>
                    <th>Aksi</th>
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
                            <a href="?hapus=<?= $data["id"] ?>"><button>Hapus</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
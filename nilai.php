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

if (!isset($_GET["id"])) {
?>
    <script>
        document.location = 'dashboard.php';
    </script>
    <?php
}

if (isset($_POST["konfirmasi"])) {
    $idSiswa = $_POST["idSiswa"];
    $jumlah_bisa = 0;
    if ($_POST["langkah1"] == "bisa") {
        $jumlah_bisa += 1;
    }
    if ($_POST["langkah2"] == "bisa") {
        $jumlah_bisa += 1;
    }
    if ($_POST["langkah3"] == "bisa") {
        $jumlah_bisa += 1;
    }
    if ($_POST["langkah4"] == "bisa") {
        $jumlah_bisa += 1;
    }
    if ($_POST["langkah5"] == "bisa") {
        $jumlah_bisa += 1;
    }
    $nilai = $jumlah_bisa / 5 * 100;
    $query = mysqli_query($conn, "SELECT * FROM student WHERE id = $idSiswa");
    $namaSiswa = mysqli_fetch_assoc($query)["name"];

    $query = mysqli_query($conn, "UPDATE `student` SET `score` = $nilai WHERE `student`.`id` = $idSiswa;");
    if ($query) {
    ?>
        <script>
            alert("<?= $namaSiswa ?> berhasil mendapat nilai <?= $nilai ?>");
            document.location = 'dashboard.php';
        </script>
<?php
    }
}
$idSiswa = $_GET["id"];
$dataPenilaian = mysqli_query($conn, "SELECT * FROM steps");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIBD - Penilaian</title>
</head>

<body>
    <a href="dashboard.php"><Button>Kembali ke dashboard</Button></a>
    <h1>Lembar Penilaian Gerak Dasar Beladiri</h1>
    <div class="card-body table-responsive">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table " id="tabel1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gerakan</th>
                        <th>Audio</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($data = mysqli_fetch_assoc($dataPenilaian)) {
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $data["step"] ?>
                                <input type="text" name="idSiswa" value="<?= $idSiswa ?>" hidden>
                            </td>
                            <td>
                                <audio controls>
                                    <source src="audio/<?= $data["audio"] ?>.mp3" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td>
                                <input type="radio" id="bisa" name="langkah<?= $i ?>" value="bisa" required>
                                  <label for="bisa">Bisa</label>
                                  <input type="radio" id="tidak_bisa" name="langkah<?= $i ?>" value="tidak_bisa" required>
                                  <label for="tidak_bisa">Tidak Bisa</label>
                            </td>
                            <?php ++$i ?>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <button type="submit" name="konfirmasi">Konfirmasi</button>
        </form>
    </div>
</body>

</html>
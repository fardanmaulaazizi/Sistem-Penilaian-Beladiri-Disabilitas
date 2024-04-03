<?php
include "koneksi.php";
session_start();

if (isset($_GET["id"])) {
    $idSiswa = $_GET["id"];
    $query = mysqli_query($conn, "SELECT * FROM student WHERE id = $idSiswa");
    $namaSiswa = mysqli_fetch_assoc($query)["name"];
}

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

    $query = mysqli_query($conn, "SELECT * FROM student WHERE id = $idSiswa");
    $namaSiswa = mysqli_fetch_assoc($query)["name"];

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
    <link rel="stylesheet" href="assets/css/dashboard/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dashboard/style.css">
</head>

<body class="m-5">
    <a href="dashboard.php"><Button class="btn btn-danger mb-5">Kembali ke dashboard</Button></a>

    <div class="d-flex w-100 justify-content-center">
        <h2>Lembar Penilaian Gerak Dasar Beladiri</h2>
    </div>
    <div class="card-body table-responsive">
        <div class="row justify-content-center">
            <div class="col-md-9 p-0">
                <div class="card p-5">
                    <div class="card-header">
                        <h4>Penilaian Siswa Bernama : <?= $namaSiswa ?></h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="text" name="idSiswa" value="<?= $idSiswa ?>" hidden>
                                <table class="table " id="tabel1">

                                    <tr>
                                        <th>No</th>
                                        <th>Gerakan</th>
                                        <th>Audio</th>
                                        <th>Nilai</th>
                                    </tr>

                                    <?php $i = 1;
                                    while ($data = mysqli_fetch_assoc($dataPenilaian)) {
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $data["step"] ?>
                                            </td>
                                            <td>
                                                <audio controls>
                                                    <source src="assets/audio/<?= $data["audio"] ?>.mp3" type="audio/mpeg">
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

                                </table>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="konfirmasi" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
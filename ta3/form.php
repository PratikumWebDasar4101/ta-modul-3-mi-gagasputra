<?php
    require("config.php");
    session_start();
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title> Form Mahasiswa </title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <form method="post" class="mhs" enctype="multipart/form-data">
        <h4><center> Form Mahasiswa </center></h4>
        <div id="isiform">
            NIM <br>
            <input type="text" id="input" name = "nim" required><br><br>
            Nama <br>
            <input type="text" name="nama" id="input" required><br><br>
            Fakultas 
            <select name="fakultas" id="fakultas" required><br>
            <option value="FTE"> FTE </option>
            <option value="FIF"> FIF </option>
            <option value="FRI"> FRI </option>
            <option value="FEB"> FEB </option>
            <option value="FKB"> FKB </option>
            <option value="FIK"> FIK </option>
            <option value="FIT"> FIT </option>
            </select>
            <br><br>
            Jenis Kelamin :
            <input type="radio" name="jenis_kelamin" id="radio" value="Laki-Laki" > Laki-Laki 
            <input type="radio" name="jenis_kelamin" id="radio" value="Perempuan" > Perempuan <br><br>
            Foto :
            <input type="file" name="file" id="file" required>
            <br><br>
            <input type="submit" value="SUBMIT" id="submit">
        </div>
    </form>
    <a href="index.php?logout=iya" id="logoutmhs"><input type="button" value="LOGOUT"></a>
</body>
</html>

<?php
if (isset($_POST['nim'])) {
    $nim = $_POST['nim'];
    $nama = addslashes($_POST['nama']);
    $fakultas = $_POST['fakultas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $foto = $_FILES['file']['name'];
    $tmp_foto = $_FILES['file']['tmp_name'];
    $dir = "foto/";
    $target = $dir.$foto;

    $ceknim = $pdo -> prepare("SELECT * FROM mahasiswa WHERE nim = '$nim'");
    $ceknim -> execute();
    $isi = $ceknim -> rowcount();

    if ($isi == 0) {
        if (!move_uploaded_file($tmp_foto, $target)) {
            die ("Upload Gagal!");
        }

        $kueri = $pdo -> prepare("INSERT INTO mahasiswa VALUES ('$username', '$nim', '$nama', '$fakultas', '$jenis_kelamin', '$target')");
        $kueri -> execute();
        
        if ($kueri) {
            ?>
            <script type="text/javascript">
            alert("Berhasil Input!");
            location = "mahasiswa.php";
            </script>
            <?php
        } else {
            die ("Input Gagal!");
        }
    } else { 
        ?>
        <script type="text/javascript">
        alert("NIM telah terdaftar!");
        </script>
        <?php
    }
}
?>
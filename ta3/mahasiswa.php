<?php
    require("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title> Data Mahasiswa </title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <h2><center> Data Mahasiswa </center></h2>
    <div id="tombol">
        <a href="form.php"><input type="button" value="Tambah Data" id="tombols"></a>
        <a href="index.php?logout=iya"><input type="button" id="tombols" value="LOGOUT"></a>
    </div>
    <div class="mahasiswa">
        <table border="1">
            <tr>
                <th> No </th>
                <th> NIM </th>
                <th> Nama </th>
                <th> Fakultas </th>
                <th> Jenis Kelamin </th>
                <th> Foto </th>
            </tr>
            <?php
                $no = 1;
                $kueri = $pdo -> prepare("SELECT * FROM mahasiswa");
                $kueri -> execute();
                while ($mahasiswa = $kueri -> fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                    <td width="5%"><?php echo $no;?></td>
                    <td width="10%"><?php echo $mahasiswa['nim'];?></td>
                    <td width="30%"><?php echo $mahasiswa['nama'];?></td>
                    <td width="10%"><?php echo $mahasiswa['fakultas'];?></td>
                    <td width="12%"><?php echo $mahasiswa['jenis_kelamin'];?></td>
                    <td><img src="<?php echo $mahasiswa['foto'];?>" width=20%;></td>
                </tr>
            <?php
                $no++;
                }
            ?>
        </table>
    </div> 
</body>
</html>
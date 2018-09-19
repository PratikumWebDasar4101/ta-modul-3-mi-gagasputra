<?php
require("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title> Register </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" class="login">
    <h4><center> REGISTRASI </center></h4>
        Username    : <input type="text" name="username" id="input"><br><br>
        Password&nbsp;   : <input type="password" name="password" id="input"><br><br>
        <input type="submit" name="submit" id="submitreg" value="REGISTER" >
    </form>
    <a href="index.php"><input type="button" id="logreg" value="LOGIN" ></a>
</body>
</html>

<?php
if(isset($_POST['username'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$kueri = $pdo -> prepare("INSERT INTO akun VALUES('$username','$password')");
$kueri -> execute();

if($kueri) {
    ?>
    <script type="text/javascript">
    alert ("Registrasi Berhasil");
    location = "index.php";
    </script>
    <?php
}
else {
    die("Gagal Registrasi");
}
}
?>
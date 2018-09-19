<?php
    require("config.php");
    session_start();
    if (@$_SESSION['pesan']) {
        header("Location: form.php");
    }

    if (@$_GET['logout']) {
        session_destroy();
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" class="login">
    <h4><center> LOGIN </center></h4>
        Username    : <input type="text" name="username" id="input"><br><br>
        Password&nbsp;   : <input type="password" name="password" id="input"><br><br>
        <input type="submit" name="submit" id="submitlog" value="LOGIN" >
    </form>
    <a href="register.php"><input type="submit" id="logreg" value="REGISTER" ></a>
</body>
</html>
<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $kueri = $pdo -> prepare("SELECT * FROM akun WHERE username = '$username' AND password = '$password'");
    $kueri -> execute();
    $isi = $kueri -> rowcount();
    $mahasiswa = $kueri -> fetch(PDO::FETCH_ASSOC);

    if ($isi != 0) {
        $_SESSION['username'] = $mahasiswa['username'];
        $_SESSION['pesan'] = "LOGIN BERHASIL";
        header("Location: form.php");
    } else {
        ?>
        <script type="text/javascript">
        alert("Username atau Password Salah!");
        </script>
        <?php
    }
}
?>


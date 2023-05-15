<?php
session_start();
include('config/dbconnection.php');

extract($_POST);
//print_r($_POST);
//die();
$ip = $_SERVER["REMOTE_ADDR"];

$admin = $con->prepare("select * from  admin where username = :username");
$admin->execute([
    'username' => $username
]);

$admin_exe = $admin->fetch(PDO::FETCH_OBJ);
$db_password = $admin_exe->password;
//print_r($db_password);
//die();
if (password_verify($password, $db_password)) {
    $_SESSION['user'] = $username;
    $_SESSION['type'] = $admin_exe->type;
    $_SESSION['user_id'] = $admin_exe->username;
    $_SESSION['login_id'] = $admin_exe->entry_id;
    $_SESSION['Acbal'] = $admin_exe->Account_bal;

    $date = date("d-m-Y");
    $time = date("h:i A");
    $time = $date . " - " . $time;
//    print_r($date);
//    die();
    $insert_log = $con->query("INSERT INTO `alogs` (`admin_link`, `time`, `ip`) VALUES ('$admin_exe->entry_id', '$time', '$ip')");

    echo "<script>document.location.href='index.php'</script>";
} else {
    echo "<script>document.location.href='login.php?err=pwd'</script>";
}
?>
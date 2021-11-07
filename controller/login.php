<?php
require  view('login');
$user = $_POST['user'];
$pass = $_POST['password'];
$query = $baglan->prepare('SELECT * FROM admin WHERE yoneticiadi = :username and yoneticipass = :password');
$query->execute([
    'username' => $user,
    'password' => $pass
]);
$row = $query->fetch(PDO::FETCH_ASSOC);

if($_POST)
{
    if($row)
    {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        header( "refresh:0.25; admin" );
    }
    else
    {
        header('Location: login');
    }
}

if (isset( $_SESSION['user'])){
    header( "Location: admin" );
}
?>
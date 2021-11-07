<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>ETR Airport Otomasyon Sistemi</title>
    <link rel="icon" href="<?=URL.'img/logo.png'?>">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap5.min.css">

    <!-- Custom styles for this template -->
    <link href="css/login.css?=<?=time()?>" rel="stylesheet">

</head>
<body class="text-center">

<main class="form-signin">
    <form action="" method="post">
        <img class="mb-4" src="img/logo.png" alt="" width="150" height="150">
        <h1 class="h3 mb-3 fw-normal">Lütfen giriş yapınız</h1>

        <div class="form-floating">
            <input name="user" type="user" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Kullanıcı Adı</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Şifre</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Beni Hatırla
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>
        <p class="mt-5 mb-3 text-muted">&copy; 1860–2021</p>
    </form>
</main>
</body>
</html>

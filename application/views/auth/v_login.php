<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Koperasi</title>
    <link href="<?= base_url() ?>material/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>material/css/form.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>material/assets/img/icon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="text-center">
    <main class="form-signin">
        <form action="<?= base_url('auth/process') ?>" method="post">
            <img class="mb-4" src="<?= base_url() ?>material/assets/img/icon.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Login Koperasi</h1>

            <div class="form-floating">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="form-floating">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
        </form>
        <footer class="footer mt-auto">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 small">
                        Copyright &copy; BPS Jawa Timur <?= date('Y') ?>
                    </div>
                </div>
            </div>
        </footer>
    </main>
</body>

</html>
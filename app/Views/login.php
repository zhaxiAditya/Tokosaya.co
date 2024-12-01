<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url('css/style.css');?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" style="position: absolute;" role="alert">
            <?php echo session()->getFlashdata('pesan');?>
        </div>
    <?php endif; ?>
    <section>
        <form action="<?php echo base_url('/masuk')?>" method="post">
            <a href="/">
                <img src="<?php echo base_url('assets/logos.jpg');?>" alt="">
            </a>
            <?php if (session()->getFlashdata('error')): ?>
                <div style="font-size: 0.7rem; font-style: italic; color: red;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <p>Selamat datang Kembali</p>
            <input type="text" placeholder="Email Adress" name="email" autofocus require>
            <input type="password" placeholder="Password" name="password" require>
            <button name="btn-login">Login</button>
            <p>Tidak memiliki akun? <a href="<?php echo base_url('user');?>">Register</a></p>
        </form>
    </section>
</body>
</html>
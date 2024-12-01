<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url('css/style.css');?>">

</head>
<body>
    <section>
        <form action="/save" method="post">
            <a href="/">
                <img src="<?php echo base_url('assets/logos.jpg');?>" alt="">
            </a>
            <?php if (isset($validation)): ?>
                <div style="font-size: 0.7rem; font-style: italic; color: red;">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <p>Managemen Produk, gampang dan cepat</p>
            <input type="email" name="email" placeholder="Email Adress" require>
            <input type="password" name="pass" placeholder="Password" require>
            <button>Register</button>
            <p>Sudah memiliki akun? <a href="<?php echo base_url('user/login');?>">Login</a></p>
        </form>
    </section>
</body>
</html>
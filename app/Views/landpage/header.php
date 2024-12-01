<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Library Tambahan -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="<?= base_url('/css/homepage.css');?>">
    <link rel="stylesheet" href="<?= base_url('/css/harga.css');?>">
    <link rel="stylesheet" href="<?= base_url('/css/kebijkan.css');?>">

</head>
<body>
        <!-- NAVBAR -->
    <nav>
        <div class="logo"><a href="<?= base_url('/');?>">TokoSaya<sup>Co</sup></a></div>
        <div class="bar">
            <a href="<?= base_url('/harga');?>">Harga</a>
            <a href="<?= base_url('/kebijakan');?>">Privasi</a>
            <a href="<?= base_url('/kontak');?>">Kontak</a>
            <a href="<?= base_url('/user');?>">Daftar</a>
        </div>
    </nav>
</body>
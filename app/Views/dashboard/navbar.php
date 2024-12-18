<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard Menu</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    
    * {
        font-family: "Poppins", sans-serif;
        margin: 0;
    }

    body {
        width: 100%;
        height: 100vh;
        display: grid;
        grid-template-columns: 25% auto;
        grid-template-rows: 7vh 93vh;
        grid-template-areas: 
        'header header'
        'sidebar content';
    }
    .nav-lift {
        grid-area: sidebar;
        padding: 1rem;
        border-right: 1px solid #969696;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .nav-lift nav {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .nav-lift nav a {
        padding: 0.5rem 0.8rem;
        text-decoration: none;
        background-color: #696868;
        font-weight: 600;
        color: #fefefe;
        border-radius: 0.2rem;
    }
    .nav-lift nav a:hover {
    color: inherit; /* Tidak mengubah warna teks */
    text-decoration: none; /* Tidak ada garis bawah saat hover */
    }
    .nav-top section a {
        padding: 0.5rem 0.8rem;
        text-decoration: none;
        background-color: #696868;
        font-weight: 600;
        color: #fefefe;
        border-radius: 0.2rem;
    }
    .nav-top section a:hover {
    color: inherit; /* Tidak mengubah warna teks */
    text-decoration: none; /* Tidak ada garis bawah saat hover */
    }

    
    .menu {
        background-color: #ffffff;
        color: #696868
    }
    .menu.active {
        background-color: #696868;
        color: #fefefe;
    }
    span {
        padding: 0px 0.25rem;
    }
    .nav-top {
        grid-area: header;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 2rem;
        border: 1px solid #969696;
    }

    /**SI content**/

    .content {
        grid-area: content;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        padding: 1rem 0px 2rem 0px;
    }
    .logout {
        display: flex; justify-content:space-between;
        align-items:center;
        background-color: red;
        color: #fefefe;
        font-weight: 600;
        text-decoration: none;
        padding: 0.5rem 0.8rem;
        border-radius: 0.2rem;
    }

</style>
<body>
    <div class="nav-lift">
        <nav>
            <a href="<?php echo base_url('dashboard');?>" class="menu active">
                <i class="fa-solid fa-boxes-packing"></i>
                <span>Produk</span>
            </a>
            <a href="<?php echo base_url('dashboard/masuk');?>" class="menu">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Produk Masuk</span>
            </a>
            <a href="<?php echo base_url('dashboard/keluar');?>" class="menu">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Produk Keluar</span>
            </a>
            <a href="<?php echo base_url('dashboard/riwayat');?>" class="menu">
                <i class="fa-solid fa-right-left"></i>
                <span>Riwayat Produk</span>
            </a>
        </nav>
        <a href="<?php echo base_url('/logout');?>" class="logout">
            <span>keluar</span>
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </a>
    </div>
    <div class="nav-top">
        <h3>Tokosaya<sup>Co</sup></h3>
        <section>
            <a href="">
                <i class="fa-solid fa-user"></i>
                <span><?php echo $email ;?></span>
            </a>
        </section>
    </div>

<script>
    // Mendapatkan path relatif dari URL saat ini tanpa query string dan fragment
    const currentPath = window.location.pathname;

    // Menyeleksi semua elemen dengan kelas "menu"
    const menuItems = document.querySelectorAll('.menu');

    menuItems.forEach(item => {
        // Ambil path relatif dari href dan hilangkan query string serta fragment
        const linkPath = new URL(item.getAttribute('href'), window.location.href).pathname;

        // Jika linkPath sama dengan currentPath, beri kelas active
        if (linkPath === currentPath) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
</script>


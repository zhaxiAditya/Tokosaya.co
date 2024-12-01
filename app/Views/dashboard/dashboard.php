
<style>
    .search {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        width: 80%;
    }

    .table-container {
    width: 80%;
    border-radius: 8px;
    overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th, td {
        padding: 12px 16px;
    }

    th {
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #a7a7a7;
    }
    tr:nth-child(even) {
        background-color: #f5f5f5;
    }
    input {
        padding: 0.5rem 0.8rem;
        font-weight: 600;
        color: #3f3f3f;
        border-radius: 0.5rem;
        border: 1px solid #a7a7a7;
        width: 60%;
        transition: ease-in 0.2s;
    }
    input:focus {
        outline: none;
    }

</style>
<body>
    <div class="content">
        <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashdata('pesan');?>
            </div>
        <?php endif; ?>
        <h3 style="width: 80%;">Produk Toko</h3>
        <div class="search">
            <input type="text" placeholder="Cari Produk">
            <a href="<?php echo base_url('dashboard/add');?>"><i class="fa-solid fa-plus"></i> Tambahkan Produk</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($produk as $k): ?>
                    <tr>
                        <td><?php echo $i ;?></td>
                        <td><?php echo $k['idProduk'];?></td>
                        <td><?php echo $k['namaProduk'];?></td>
                        <td><?php echo $k['kategori'];?></td>
                        <td><?= number_format($k['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $k['jumlah'];?></td>
                        <td><a href="">Details</a></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


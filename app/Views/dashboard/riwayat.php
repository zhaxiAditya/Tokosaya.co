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
    .search input {
        padding: 0.5rem 0.8rem;
        font-weight: 600;
        color: #3f3f3f;
        border-radius: 0.5rem;
        border: 1px solid #a7a7a7;
        width: 500px;
        transition: ease-in 0.2s;
    }
    input:focus {
        outline: none;
    }
    button {
        padding: 0.5rem 0.8rem;
        font-weight: 600;
        color: #3f3f3f;
        border-radius: 0.5rem;
        border: 1px solid #a7a7a7;
    }

    .Baru {
        background-color: #B7E0FF;
        padding: 0.2rem 0.3rem;
        font-weight: 600;
        color: #ffffff;
        border-radius: 5px;
        text-align:center;
    }
    .Masuk {
        background-color: #9EDF9C;
        padding: 0.2rem 0.3rem;
        font-weight: 600;
        color: #ffffff;
        border-radius: 5px;
        text-align:center;
    }
    .Keluar {
        background-color: #F72C5B;
        padding: 0.2rem 0.3rem;
        font-weight: 600;
        color: #ffffff;
        border-radius: 5px;
        text-align:center;
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
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * (1 - 1)); ?>
                    <?php foreach($produk as $k): ?>
                    <tr>
                        <td><?php echo $i ;?></td>
                        <td><?php echo $k['KodeProduk'];?></td>
                        <td><?php echo $k['namaProduk'];?></td>
                        <td><div class="<?php echo $k['status'];?>"><?php echo $k['status'];?></div></td>
                        <td><?php echo $k['jumlah'];?></td>
                        <td><?php echo $k['tanggal'];?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('riwayat', 'pager') ?>
        </div>
    </div>
</body>
</html>
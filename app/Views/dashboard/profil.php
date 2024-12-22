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
    .search a {
        display: flex;
        flex-direction: row;
        gap: 1rem;
        align-items: center;
    }

    .search a {
        padding: 0.5rem 0.8rem;
        text-decoration: none;
        background-color: #696868;
        font-weight: 600;
        color: #fefefe;
        border-radius: 0.2rem;
    }

    td a {
        padding: 0.5rem 0.8rem;
        text-decoration: none;
        background-color: #696868;
        font-weight: 600;
        color: #fefefe;
        border-radius: 0.2rem;
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

</style>
<body>
    <div class="content">
        <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashdata('pesan');?>
            </div>
        <?php endif; ?>
        <h3 style="width: 80%;">Tokosaya</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama paket</th>
                        <th>No Resi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($belanja as $b):
 ?>
                    <tr>
                        <td><?php echo $b['namaMembership'] ;?></td>
                        <td><?php echo $b['noToken'];?></td>
                        <td><?php echo $b['harga'];?></td>
                        <td><?php echo $b['durasi'];?>Hari</td>
                        <td><?= $b['status'];?></td>
                        <td style="display: flex; gap: 1rem;">
                            <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/<?php echo $b['noToken'];?>">Bayar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
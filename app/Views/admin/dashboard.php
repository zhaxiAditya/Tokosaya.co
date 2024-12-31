
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
        display: flex;
        flex-direction: row;
        gap: 1rem;
        align-items: center;
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
        <h3 style="width: 80%;">Data user</h3>
        <div class="search">
            <form action="" method="post">
            <input type="text" name="keyword" placeholder="Cari User">
            <button>Cari</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>email</th>
                        <th>Status Membership</th>
                        <th>Tanggal Akhir Langganan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($user as $u): ?>
                    <tr>
                        <td><?php echo $i ;?></td>
                        <td><?php echo $u['email'];?></td>
                        <td><?php
                        $user = $u['status'];
                        if($user == 'aktif'){
                            echo 'Aktif';
                        }else {
                            echo 'Tidak Aktif';
                        }
                        ?></td>
                        <td><?php echo $u['tanggalAkhir'];?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


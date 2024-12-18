
<style>
        .content section {
        width: 100%;
        padding: 0px 5% 0px 5%;
    }
    header {
        display: flex;
        border-bottom: 2px solid #969696;
        padding: 0.5rem 10px;
        margin: 0.3rem 0px;
        justify-content: space-between;
    }
    header form {
        display: flex;
        width: 80%;
        justify-content: end;
    }

    .items {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #e2dfdf;
        padding: 0.5rem;
        border-radius: 0.1rem;
        border-bottom: 1px solid #696868;
        margin-bottom: 0.5rem;
    }
    input, button {
        margin: 0px 0.5rem;
        padding: 0.5rem;
        border-radius: 0.2rem
    }
    input {
        border: 1px solid #969696;
    }
    button {
        background-color: aquamarine;
        border: none;
        font-weight: 600;
    }
</style>
<div class="content">
        <section>
            <header>
                <h3>Barang Masuk</h3>
                <form action="" method="post">
                    <input type="text" name="keyword" style="width: 60%;">
                    <button style="width: 20%;">search</button>
                </form>
            </header>
            <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo session()->getFlashdata('pesan');?>
            </div>
        <?php endif; ?>
            <?php foreach($produk as $p):?>
                <div class="items">
                <h5><?php echo $p['namaProduk'];?><sub>/<?php echo $p['kodeProduk'];?> / <?php echo $p['harga'];?> / <?php echo $p['jumlah'];?></sub></h5>
                <form action="<?php echo base_url('dashboard/masuk/').$p['idProduk'];  ?>" method="post">
                    <input type="number" name="jumlah" value="1" style="width:100px; text-align: center;">
                    <input type="hidden" name="kodeProduk" value="<?php echo $p['kodeProduk'];?>">
                    <input type="hidden" name="namaProduk" value="<?php echo $p['namaProduk'];?>">
                    <button>Tambahkan</button>
                </form>
            </div>
        <?php endforeach; ?>
        <?= $pager->links('produk', 'pager') ?>
        </section>
    </div>
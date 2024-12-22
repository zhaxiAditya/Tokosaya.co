<section>
        <h1>Buka Catatan Online Produk anda Sekarang</h1>
        <p>Solusi mudah, kelola produk antar toko</p>
        <div class="contener">
            <?php foreach($membership as $m): ?>
            <div class="card">
                <h2><?= $m['namaMembership'];?></h4>
                <p><?= $m['deskripsi'];?></p>
                <h3 style="color: #78B3CE"><?= number_format($m['harga']);?><sub></h4>
                <p>Untuk <?= $m['durasi'];?> Hari</p>

                <div class="detail">
                    <form action="<?= base_url('pembayaran')?>" method="post">
                        <input type="hidden" name="idmembership" value="<?= $m['idMembership'];?>">
                        <button>Beli Sekarang</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
<style>
    .container {
        width: 80%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 0.5rem 0.7rem;
      margin-bottom: 0.7rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    button {
        padding: 0.5rem 1rem;
        border-radius: 0.2rem;
        border: 1px solid #969696;
    }

</style>
<body>
    <div class="content">
        <div class="container">
            <h2>Form Edit Produk Toko</h2>
            <form action="<?= base_url('dashboard/update/' . $produk['idProduk']) ?>" method="post">
              <?php if (isset($validation)): ?>
                <div style="font-size: 0.7rem; font-style: italic; color: red;">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
              <input type="hidden" name="idUser" value="<?php echo $iduser ?>">
              <label for="nama_barang">Nama Produk:</label>
              <input type="text" id="nama_barang" name="nama_barang" required value="<?php echo $produk['namaProduk'] ?>" >
        
              <label for="kategori">Kategori:</label>
              <select id="kategori" name="kategori">
                <option value="Elektronik" <?= $produk['kategori'] === 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                <option value="Fashion" <?= $produk['kategori'] === 'Fashion' ? 'selected' : '' ?>>Fashion</option>
                <option value="Makanan" <?= $produk['kategori'] === 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                <option value="Kecantikan & Perawatan Diri" <?= $produk['kategori'] === 'Kecantikan & Perawatan Diri' ? 'selected' : '' ?>>Kecantikan & Perawatan Diri</option>
                <option value="Perlengkapan Rumah Tangga" <?= $produk['kategori'] === 'Perlengkapan Rumah Tangga' ? 'selected' : '' ?>>Perlengkapan Rumah Tangga</option>
                <option value="Olahraga & Hobi" <?= $produk['kategori'] === 'Olahraga & Hobi' ? 'selected' : '' ?>>Olahraga & Hobi</option>
                <option value="Anak-Anak & Bayi" <?= $produk['kategori'] === 'Anak-Anak & Bayi' ? 'selected' : '' ?>>Anak-Anak & Bayi</option>
                <option value="Otomotif" <?= $produk['kategori'] === 'Otomotif' ? 'selected' : '' ?>>Otomotif</option>
                <option value="Buku & Alat Tulis" <?= $produk['kategori'] === 'Buku & Alat Tulis' ? 'selected' : '' ?>>Buku & Alat Tulis</option>
                <option value="Kesehatan" <?= $produk['kategori'] === 'Kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
                <option value="Gaming & Digital" <?= $produk['kategori'] === 'Gaming & Digital' ? 'selected' : '' ?>>Gaming & Digital</option>
              </select>
        
              <label for="harga">Harga:</label>
              <input type="number" id="harga" name="harga" required value="<?php echo $produk['harga'] ?>">

              <div class="button-container">
                <button type="submit">Simpan</button>
                <button type="button" style="background-color: red;">Batal</button>
              </div>
            </form>
          </div>
    </div>
</body>
</html>
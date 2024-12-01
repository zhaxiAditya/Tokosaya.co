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
        <h3 style="width: 80%; padding-bottom: 0.5rem">Form Produk Toko</h3>
        <div class="container">
            <h2>Input Produk</h2>
            <form action="<?php echo base_url('dashboard/save')?>" method="post">
              <label for="kode_barang">Kode Produk:</label>
              <input class="is-invalid" type="text" id="kode_barang" name="kode_barang" required autoFocus value="<?php echo old('Kode_barang');?>">
              <?php if (isset($validation)): ?>
                <div style="font-size: 0.7rem; font-style: italic; color: red;">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
              <input type="text" name="idUser" value="<?php echo $iduser ?>">
              <label for="nama_barang">Nama Produk:</label>
              <input type="text" id="nama_barang" name="nama_barang" required value="<?php echo old('nama_barang');?>" >
        
              <label for="kategori">Kategori:</label>
              <select id="kategori" name="kategori">
                <option value="Elektronik">Elektronik</option>
                <option value="Fashion">Fashion</option>
                <option value="Makanan">Makanan</option>
                <option value="Kecantikan & Perawatan Diri">Kecantikan & Perawatan Diri</option>
                <option value="Perlengkapan Rumah Tangga">Perlengkapan Rumah Tangga</option>
                <option value="Olahraga & Hobi">Olahraga & Hobi</option>
                <option value="Anak-Anak & Bayi">Anak-Anak & Bayi</option>
                <option value="Otomotif">Otomotif</option>
                <option value="Buku & Alat Tulis">Buku & Alat Tulis</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Gaming & Digital">Gaming & Digital</option>
              </select>
        
              <label for="jumlah ">Stok:</label>
              <input type="number" id="jumlah" name="jumlah" required value="<?php echo old('jumlah');?>">
        
              <label for="harga">Harga:</label>
              <input type="number" id="harga" name="harga" required value="<?php echo old('harga');?>">

              <label for="harga">Tanggal exp:</label>
              <input type="date" id="harga" name="expDate" required value="<?php echo old('expDate');?>">
              <br>
              <div class="button-container">
                <button type="submit">Simpan</button>
                <button type="button" style="background-color: red;">Batal</button>
              </div>
            </form>
          </div>
    </div>
</body>
</html>